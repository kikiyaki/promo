<?php


namespace promo;


class NotFoundAction implements Action
{
    private $GET;

    public function __construct($GET = null)
    {
        $this->GET = $GET ? $GET : $_GET;
    }

    public function handle()
    {
        return 'Action not found';
    }
}