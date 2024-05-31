<?php

use inc\v1\auth\Auth;

Auth::getUserOrThrow()->logOut();

header("Location: /login/");