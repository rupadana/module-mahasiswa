<?php

use Illuminate\Routing\Router;

/** @var Router $router */
$router->group(['prefix' => '/mahasiswa', 'middleware' => ['api.token', 'auth.admin']], function (Router $router) {
    $router->group(['prefix' => 'mahasiswas'], function (Router $router) {
        $router->get("/", [
            "as" => "mahasiswa.mahasiswas.index",
            "uses" => "MahasiswaController@index",
            "middleware" => "token-can:mahasiswa.mahasiswas.index"
        ]);

        $router->delete(
            "/{mahasiswa}",
            [
                "as" => "mahasiswa.mahasiswas.destroy",
                "uses" => "MahasiswaController@destroy",
                "middleware" => "token-can:mahasiswa.mahasiswas.destroy"
            ]
        );
        $router->post(
            "/",
            [
                "as" => "mahasiswa.mahasiswas.create",
                "uses" => "MahasiswaController@create",
                "middleware" => "token-can:mahasiswa.mahasiswas.create"
            ]
        );
        $router->post('mahasiswas/{mahasiswa}', [
            'as' => 'api.mahasiswa.mahasiswa.update',
            'uses' => 'MahasiswaController@update',
            'middleware' => 'token-can:mahasiswa.mahasiswas.edit'
        ]);

        $router->get("mahasiswas/{mahasiswa}", [
            'as' => 'api.mahasiswa.mahasiswa.find',
            'uses' => 'MahasiswaController@find',
            'middleware' => 'token-can:mahasiswa.mahasiswas.index'
        ]);
    });
});
