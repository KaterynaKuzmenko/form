<?php
setlocale(LC_ALL,"Russian_Russia.1251","en-US","Russian_Russia.65001");

/// admin page
function getDeprecatedWords(){
    setlocale(LC_ALL, "Russian_Russia.1251", "en-US", "Russian_Russia.65001");
    if (is_readable("depWord.db")) {
        $depWord = file_get_contents("depWord.db");
        $depWord = unserialize($depWord);
        return $depWord;
    }
    return[];
}

function addDeprecatedWords($depWord){
    if (isset($_POST['add'])) {
        if (isset($depWord)) {
            foreach ($depWord as $listWord) {
                if ($listWord['word'] == $_POST['word']) {
                    exit('Word ' . $listWord['word'] . ' is already in the list!');
                }
            }
        }
        $newDeprecatedWord['word'] = ($_POST['word']);
        $depWord[] = $newDeprecatedWord;
        $depWordDB = serialize($depWord);
        file_put_contents("depWord.db", $depWordDB);
    }
    return $depWord;
}

function showDeprecatedWord($depWord){
    if ($depWord) {
        sort($depWord);
        foreach ($depWord as $word) {
            echo $word['word'];
            echo '<br>';
        }
    }
}


// user page
function getContent(){
    if(is_readable("messages.db")){
        $messages=file_get_contents("messages.db");
        $messages=unserialize($messages);
        return $messages;
    }
    return[];
}

function addComment($messages){
    if(isset($_POST['submit'])){
        //var_dump($_POST);
        $newPost['userName']=htmlspecialchars($_POST['userName']);
        $newPost['userMessage']=htmlspecialchars($_POST['userMessage']);
        $messages[]=$newPost;
        $messagesDB=serialize($messages);
        file_put_contents("messages.db",$messagesDB);
    }
    return $messages;
}

function antiMat($messages){
    if(is_readable("depWord.db")){
        $depWord = file_get_contents("depWord.db");
        if(isset($depWord)){
            $depWord = unserialize($depWord);
            foreach ($messages as $post) {
                foreach ($depWord as $word) {
                    $post['userName'] = str_ireplace($word, "CENSORED", $post['userName']);
                    $post['userMessage'] = str_ireplace($word, "CENSORED", $post['userMessage']);
                }
                $message[] = $post;
            }
        }
    }
        return $message;
}

function showContent($message){
    if(isset($message)){
        $message = array_reverse($message);
        foreach($message as $post){
            if($post['userName'] == ''){
                $post['userName'] = 'guest';
            }
            echo "<div class='message'><p class='userName'>user: {$post['userName']} writes...</p>{$post['userMessage']}</div>";
            echo "<div></div>";
            echo '<br>';

        }
    }
}

/// don't touch it's correct without change
/*function showContent($messages){
    if(isset($messages)){
        if(is_readable("depWord.db")){
            $depWord = file_get_contents("depWord.db");
            if(isset($depWord)){
                $depWord = unserialize($depWord);
                $messages = array_reverse($messages);
                foreach ($messages as $post) {
                    foreach ($depWord as $word) { //если очистить depWord.db при добавлении превого слова появляется ошибка - почему отрабатывает sort если если есть if
                        $post['userName'] = str_ireplace($word, "CENSORED", $post['userName']);
                        $post['userMessage'] = str_ireplace($word, "CENSORED", $post['userMessage']);
                    }
                    echo "user: {$post['userName']} writes...";
                    echo "{$post['userMessage']}";
                    echo '<br>';
                }
            }
        }
    }
}*/


// save - class work

/*function showContent($messages){
    if(isset($messages)){
        $cens=['bad','fuck','worst'];
        $messages=array_reverse($messages);
        foreach($messages as $post){
            foreach($cens as $word){
                $post['userName']=str_ireplace($word,"CENSORED",$post['userName']);
                $post['userMessage']=str_ireplace($word,"CENSORED",$post['userMessage']);
            }
            echo"<label>user: {$post['userName']} writes...</label>";
            echo"<div>{$post['userMessage']}</div>";
            echo'<br>';
        }
    }
}*/