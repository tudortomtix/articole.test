<div class="back">
    <i class="fa fa-chevron-left" aria-hidden="true"></i>
    <a href="javascript:history.go(-1)">Back</a>
</div>    
<form name="addArticle" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" enctype="multipart/form-data">
    <div class="titlefull">
        <label for="Article['title']"></label>
        <input type="text" name="addArticle[title]" id="addArticle[title]" value="Title" />
    </div>
    <div class="data">
  
    </div>
    <div class="bodyfull">
        <label for="addArticle['body']"></label>
        <script type="text/javascript" src="third_party/ckeditor/ckeditor.js"></script>
        <textarea name="addArticle[body]" id="addArticle[body]" class="ckeditor">Body</textarea>
    </div>
    <div>
        <label>Incarca PhotoCover: </label>
        <input type="file" name="fileToUpload" id="fileToUpload" class="fileupload">
         <select name="addArticle[category_id]" id="addArticle[category_id]" class="select">
            <option selected disabled>Alege categoria</option>
            <option value="1">Stiinta</option>
            <option value="2">Cultura</option>
            <option value="3">Natura</option>
        </select>
    </div>
    <div>
        <input class="button" type="submit" name="addArticle[saveArticle]" value="Add" />
    </div>   
</form>