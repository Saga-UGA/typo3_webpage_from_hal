<?php
namespace SAGA\WebpageFromHal\Exceptions;

class BadHttpRequestException extends HalException
{
    protected $message = 'The request can\'t be reached';
}