<?php

namespace inc\v1\request\http_methods;

/**
 * Все доступные методы
 */
enum HttpMethods
{
    case GET;
    case POST;
    case PUT;
    case DELETE;
    case COPY;
}