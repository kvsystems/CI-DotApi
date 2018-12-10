<?php
class Crypt {

    public function generateMd5()   {
        $Characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";
        $CurrentHash = "";
        $CharacterLenght = strlen($Characters) - 1;
        while (strlen($CurrentHash) < 10) {
            $CurrentHash .= $Characters[mt_rand(0,$CharacterLenght)];
        }
        return md5($CurrentHash);
    }

}