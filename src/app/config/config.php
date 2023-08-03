<?php

//DB Params
const DB_HOST = 'eliot_db';
const DB_USER = 'user';
const DB_PASS = 'root';
const DB_NAME = 'eliot';

//Pouting params
const DEFAULT_CONTROLLER = 'DefaultController::index';
const ROUTES = [
    '/' => DEFAULT_CONTROLLER,
    '/add-comment' => 'CommentController::index',
];

//Messages
const EMAIL_SENDER = 'sender@example.com';
const EMAIL_SUBJECT = 'New comment added';
const EMAIL_MESSAGE = 'Thank you for comment!';

const SMS_URL_SERVICE = 'https://freemessages.com/sms/send';
const SMS_DEFAULT_PHONE_NUMBER = '123456789';
const SMS_API_KEY = 'example_api_key';
const SMS_MESSAGE = 'A new comment has been added to the website.';


//Defaults
const ERROR_MESSAGE = 'Page not found!';
const ERROR_FIELDS = 'Not valid data';