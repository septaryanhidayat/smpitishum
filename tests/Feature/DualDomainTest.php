<?php

test('website can be accessed via primary school domain', function () {
    $response = $this->get('https://smpitishum.sch.id/');

    $response->assertStatus(200);
});

test('website can be accessed via secondary school domain', function () {
    $response = $this->get('https://smpitishlahulummah.sch.id/');

    $response->assertStatus(200);
});

test('subpages are reachable across domains', function () {
    $response1 = $this->get('https://smpitishum.sch.id/hubungi');
    $response1->assertStatus(200);

    $response2 = $this->get('https://smpitishlahulummah.sch.id/hubungi');
    $response2->assertStatus(200);
});
