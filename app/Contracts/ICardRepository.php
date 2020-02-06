<?php

interface ICardRepository{
    public function save($card);
    public function findById($id);
}