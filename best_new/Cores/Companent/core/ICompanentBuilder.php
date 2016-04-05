<?php namespace Era\Core\Companent;
interface ICompanentBuilder {
    public function setVersion($version = '0.0.0');
    public function getVersion();
    public function compareVersion($version = '0.0.0');
    public function validVersion();
    public function validIBuilder();
    public function validABuilder();
}