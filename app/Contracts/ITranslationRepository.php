<?php

interface ITranslationRepository {

    public function save($translation): int;
    
    public function findTranslation(string $translation);
}
