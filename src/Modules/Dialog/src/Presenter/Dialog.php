<?php

namespace Dialog\Presenter;

use JetBrains\PhpStorm\ArrayShape;
use User\Presenter\User;

class Dialog
{
    public static function presentCollectionDialog(array $dialogs): array
    {
        $result = [];
        foreach ($dialogs as $dialog) {
            $result[] = [
                'id' => $dialog->getId(),
                'user' => [
                    'id' => $dialog->getUser()->getId()
                ],
                'message' => [
                    'id' => $dialog->getMessage()->getId(),
                    'text' => $dialog->getMessage()->getText()
                ]
            ];
        }
        return $result;
    }

    public static function presentCollectionListDialog(array $dialogs): array
    {
        $result = [];
        foreach ($dialogs as $dialog) {
            $result[] = [
                'id' => $dialog->getId()
            ];
        }
        return $result;
    }

}