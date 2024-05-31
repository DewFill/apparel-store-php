<?php

namespace inc\v1\http_response_code_handler;

enum HTTPResponse: int
{
    case OK = 200;
    case PERMANENT_REDIRECT = 301;
    case BAD_REQUEST = 400;
    case NOT_FOUND = 404;
    case UNAUTHORIZED = 401;
    case METHOD_NOT_ALLOWED = 405;
    case UNPROCESSABLE_ENTITY = 422;
    case INTERNAL_SERVER_ERROR = 500;
}