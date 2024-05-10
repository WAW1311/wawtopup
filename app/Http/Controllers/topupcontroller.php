<?php

namespace App\Http\Controllers;

class topupcontroller extends Controller
{
    public function ml() {
        $product = $this->get_order();
        $order_id = $this->generateuuid();
        return view('products.mobilelegends',compact('product','order_id'));
    }
    public function mlb() {
        $product = $this->get_order();
        $order_id = $this->generateuuid();
        return view('products.mobilelegendsb',compact('product','order_id'));
    }
    public function freefire() {
        $product = $this->get_order();
        $order_id = $this->generateuuid();
        return view('products.freefire',compact('product','order_id'));
    }
    public function pubgm() {
        $product = $this->get_order();
        $order_id = $this->generateuuid();
        return view('products.pubgm',compact('product','order_id'));
    }
    public function genshin() {
        $product = $this->get_order();
        $order_id = $this->generateuuid();
        return view('products.genshin',compact('product','order_id'));
    }
    public function coc() {
        $product = $this->get_order();
        $order_id = $this->generateuuid();
        return view('products.coc',compact('product','order_id'));
    }
    public function valorant() {
        $product = $this->get_order();
        $order_id = $this->generateuuid();
        return view('products.valorant',compact('product','order_id'));
    }
    public function cod() {
        $product = $this->get_order();
        $order_id = $this->generateuuid();
        return view('products.cod',compact('product','order_id'));
    }
    public function hoi() {
        $product = $this->get_order();
        $order_id = $this->generateuuid();
        return view('products.hoi3',compact('product','order_id'));
    }
    public function aov() {
        $product = $this->get_order();
        $order_id = $this->generateuuid();
        return view('products.aov',compact('product','order_id'));
    }
    public function tof() {
        $product = $this->get_order();
        $order_id = $this->generateuuid();
        return view('products.tof',compact('product','order_id'));
    }
    public function ballpool() {
        $product = $this->get_order();
        $order_id = $this->generateuuid();
        return view('products.8ballpool',compact('product','order_id'));
    }

}
