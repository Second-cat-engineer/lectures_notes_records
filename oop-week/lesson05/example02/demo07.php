<?php

class Disc
{
    private $tracks = [1, 2, 3, 4];

    public function getTracksCount(): int
    {
        return count($this->tracks);
    }
}