<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace common\models;
/**
 *
 * @author jarek
 */
interface IUser
{
    public static function findByUsername($username);
}