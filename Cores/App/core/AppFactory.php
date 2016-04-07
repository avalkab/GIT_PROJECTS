<?php
    class Factory extends Singleton {
        public function buildCompanent() {
            include('cores/Companent/Companent.php');
            return new CompanentBuilder;
        }
    }