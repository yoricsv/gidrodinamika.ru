<?php 
$set_var = array("action");        //for logo_search.php

foreach($set_var as $key => $val)
{
    if(empty($$val))
    {
        $$val = '';
    }
}
?>

<a href    = "Главная"
   onclick = "this.href = 'index.php'"
>
    <img    alt     = "Logo" 
            id      = "logo" 
            height  = "71" 
            src     = "img/logo.png"  
            width   = "378"
    />
</a>

<form action = "search_page.php"
      id     = "keyword"
      method = "post"
      
>
    <p>
        <input  id      = "query"
                name    = "query"
                onblur  = "clearInput  (this)"
                onfocus = "defaultInput(this)"
                title   = "Поиск..."
                type    = "text" 
                value   = ""
        />
    </p>
    <p>
        <input  id      = "go"
                type    = "submit"
                value   = ""
        />
    </p>
    <div class = "clear"></div>
</form>