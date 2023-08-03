<?php
namespace App\Controller;

use App\Service\CommentService;
use App\Service\EmailService;
use App\Service\SmsService;
use App\Service\Validator;
use Exception;

class CommentController
{
    private CommentService $commentService;
    private EmailService $emailService;
    private SmsService $smsService;

    public function __construct()
    {
        $this->commentService = new CommentService();
        $this->emailService = new EmailService();
        $this->smsService = new SmsService();
    }

    /**
     * @throws Exception
     */
    public function postIndex(): void
    {
        if (isset($_POST['comment']) && isset($_POST['email'])) {
            $validator = new Validator($_POST);
            $validator->validateRequired('comment');
            $validator->validateEmail('email');
            $errors = $validator->errors();

            $comment = $_POST['comment'];
            $email = $_POST['email'];

            if (empty($errors)) {
                $this->commentService->addComment($comment, $email);

                $headers = 'From: ' . EMAIL_SENDER . "\r\n" .
                    'Reply-To: ' . EMAIL_SENDER . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();
                $this->emailService->sendEmail($email, EMAIL_SUBJECT, EMAIL_MESSAGE, $headers);
                $this->smsService->sendSms();
            }
        }

        header("Location: /");
    }
}

