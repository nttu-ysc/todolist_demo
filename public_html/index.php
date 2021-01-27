<?php include('header.php') ?>
<?php include('data.php') ?>
<?php include('navbar_user.php') ?>
<?php
session_start();

if (!isset($_SESSION['user_logged_in']) || ($_SESSION['user_logged_in'] == "")) {
    header("Location: login.php");
}
?>
<div id="panel">
    <h1>Todo List</h1>
    <div id="todo-list">
        <ul>
            <li class="new">
                <div class="checkbox"></div>
                <div class="content" contenteditable="true"></div>
            </li>

        </ul>
    </div>
</div>

<script id="todo-list-item-template" type="text/x-handlebars-template">
    <li data-id="{{id}}" class="{{#if iscomplete}}complete{{/if}}">
        <div class="checkbox"></div>
        <div class="content">{{content}}</div>
        <div class="action">
            <div class="delete">X</div>
        </div>
    </li>
</script>
<?php include('footer.php') ?>