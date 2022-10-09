<?php
use App\Models\Admin\UserRole;
use App\Models\Admin\Company;
use App\Models\Admin\Brand;
use App\Models\Admin\Color;
use App\Models\Admin\Product;

function getAllUserRoles(){
    $user_role = new UserRole();
    return $user_role->getAll();
}

function getAllCompanys(){
    $companys = new Company();
    return $companys->getAllCompany();
}

function getAllBrands(){
    $brands = new Brand();
    return $brands->getAllBrand();
}

function getAllColors(){
    $colors = new Color();
    return $colors->getAllColor();
}

function getAllProducts(){
    $products = new Product();
    return $products->getAllProducts();
}