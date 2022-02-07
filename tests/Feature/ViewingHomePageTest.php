<?php

test('Home page can be accessed by everybody', function() {
    $this->get('/')->assertStatus(200);
});
