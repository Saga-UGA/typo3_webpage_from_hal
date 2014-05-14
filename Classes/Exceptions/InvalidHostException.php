<?php
namespace SAGA\WebpageFromHal\Exceptions;

class InvalidHostException extends HalException
{
    protected $message = 'Invalid host';
}