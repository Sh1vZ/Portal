<?php
if (isset($_GET['msg'])) {
  if ("insertSuccess" == $_GET['msg']) {
    echo '
            <div class="alert alert-success" role="alert">
             Insert Success
            </div>
            ';
  }
  if ("updateSuccess" == $_GET['msg']) {
    echo '
            <div class="alert alert-success" role="alert">
             Update Success
            </div>
            ';
  }
  if ("deleteSuccess" == $_GET['msg']) {
    echo '
            <div class="alert alert-success" role="alert">
             Delete Success
            </div>
            ';
  }
  if ("emptyFields" == $_GET['msg']) {
    echo '
            <div class="alert alert-danger" role="alert">
             Fill all the fields in
            </div>
            ';
  }
  if ("incorrectUser" == $_GET['msg']) {
    echo '
            <div class="alert alert-danger" role="alert">
            User does not exist
            </div>
            ';
  }
  if ("incorrectPassword" == $_GET['msg']) {
    echo '
            <div class="alert alert-danger" role="alert">
            Incorrect Password
            </div>
            ';
  }
}
