$(document).ready(function() {
    initializeGalleryButtons();
    initializeTimepicker();
    initializeGallery();
});

function initializeGallery(){
    console.log("Gallery Init")
    if(window.FileReader) {
        //console.log("Ready to Drop");
        addEventHandler(window, 'load', function() {
            //var status = document.getElementById('status');
            var drop   = $("#logoCanvas");
            //var list   = document.getElementById('list');

            // Tells the browser that we *can* drop on this

            addEventHandler(drop, 'dragover', FileDragHover);
            addEventHandler(drop, 'dragenter', FileDragHover);
            addEventHandler(drop, 'drop', dropLogo);
        });
    } else {
        statusLogo('Your browser does not support the HTML5 FileReader.',1);
    }
    $(".logoCanvas").click(function(){
        $(this).siblings("[name=whiteLabelFile]").click();
        //console.log($(this).siblings("[name=whiteLabelFile]").attr("class"))
    })
    $(".import-button").click(function(){
        var inputTarget=$(this).attr("click-target");
        $("[input-target="+inputTarget+"]").click();
    })
    $(".logoClear").click(function(){
        var inputTarget=$(this).attr("click-target");
        //$("[input-target="+inputTarget+"]").click();
        $("[input-target="+inputTarget+"]").find("img").removeAttr('src');
        $("#"+inputTarget).val("");
    })
    $("[name=whiteLabelFile]").change(function(e){
        dropLogo(e);
    })


}
function markItem(obj){
    $(obj).parents('.galleryContainer').find('.gallerySelected').click();
}
function starItem(obj){
    if($(obj).parents('.galleryContainer').find('.gallerySelected').attr("checked")!="checked"){
    $(obj).parents('.galleryContainer').find('.gallerySelected').click();
    }
    $(obj).parents('.galleryContainer').find('.galleryStarred').click();
}
function dragLeave(e){
    e.stopPropagation();
    e.preventDefault();
    $(e.target).removeClass("dropHover");
}
function FileDragHover(e) {
    e.stopPropagation();
    e.preventDefault();
    $(e.target).addClass("dropHover");
    //e.target.className = (e.type == "dragover" ? "hover" : "");
}
function addEventHandler(obj, evt, handler) {
    //console.log(evt+"+"+typeof obj);
    if(obj == null ){
        console.log("+"+typeof obj)
        return false;
    }
    if(obj.addEventListener) {
        // W3C method
        obj.addEventListener(evt, handler, false);
    } else if(obj.attachEvent) {
        // IE method.
        obj.attachEvent('on'+evt, handler);
    } else {
        // Old school method.
        obj['on'+evt] = handler;
    }
}
function dropLogo(e){
    destination=($(e.target).siblings(".logoCanvas").attr("input-target"));
    // cancel event and hover styling
    FileDragHover(e);

    // fetch FileList object
    var files = e.target.files || e.dataTransfer.files;

    // process all File objects
    //e.target.innerHTML= "<img src='"+files[0].mozFullPath+"'>";

    for (var i = 0, f; f = files[i]; i++) {
        if(f.type.indexOf("image")>-1){
            ParseImage(f,destination);
        }else{

            console.log(f.type);
        }
    }
}
function ParseImage(file,destination){
    console.log(destination);
    var reader = new FileReader();
    reader.onload = function(e) {
        $(".logoCanvas[input-target="+destination+"]").html("<img alt='" + file.name + "' src='" + e.target.result + "' />");
        $(".logoCanvas[input-target="+destination+"] img").fadeIn("slow",UploadFile(file,destination));
    }
    reader.readAsDataURL(file);
    //console.log(reader);
}
function UploadFile(file,destination){
    statusLogo("Subiendo Imagen...",1,destination);
    var xhr = new XMLHttpRequest();
    if (xhr.upload && file.type.indexOf("image")>-1 && file.size <= $("#MAX_FILE_SIZE").val()) {
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 201) {
                var responseArray = JSON.parse(xhr.responseText);
                //$("#"+destination).val(responseArray.files[0].name);
                statusLogo("Imagen Subida",1);
                $(".logoCanvas[input-target="+destination+"]").css({
                    "animation-name": "none"
                });
                newNode = $("#galleryTableHidden .newImage").clone();
                console.log(newNode);
                newNode.find(".previewGallery").attr("href",responseArray['path']);
                newNode.find(".previewGallery").attr("title",responseArray['filename']);
                newNode.find(".imgButtons").attr("image-id",responseArray['filename']);
                galleryA = newNode.find(".icon-trash").attr("gallery-action");
                newNode.find(".icon-trash").attr("gallery-action", galleryA.replace("PLACEHOLDER", responseArray['id']));
                newNode.find("img").attr("alt",responseArray['filename']);
                newNode.find("img").attr("src",responseArray['thumb']);
                newNode.find(".gallerySelected").attr("id",responseArray['id']+"-selected");
                newNode.find(".gallerySelected").val(responseArray['id']);
                newNode.find(".galleryStarred").attr("id",responseArray['id']+"-starred");
                newNode.find(".galleryStarred").val(responseArray['id']);
                newNode.find(".imgButtons").attr("image-id",responseArray['id']);

                newNode.appendTo($("#galleryTable"));
                newNode.css({
                    "animation-name": "bounceInRight",
                    "animation-duration": "1s",
                    "animation-iteration-count": "1"
                })
                initializeGalleryButtons();
            }else{
                $(".logoCanvas[input-target="+destination+"]").css({
                    "animation-name": "none"
                });
            }
        }
        xhr.open("POST", $("#upload").attr("action"), true);
        //xhr.setRequestHeader("X_FILENAME", file.name);
        xhr.setRequestHeader("Accept", "*/*");
        //xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        //xhr.setRequestHeader("Content-Type","application/JSON");
        //myFunction(myArr);
        // start upload
        //statusLogo("Subiendo Imagen ..");
        xhr.upload.addEventListener("progress", function(e) {
            var pc = parseInt(100 - (e.loaded / e.total * 100));
            //console.log(e.loaded);
            statusLogo("Subiendo Imagen "+pc+"%",1,destination);
            $(".logoCanvas[input-target="+destination+"]").css({
                "animation-name": "flash",
                "animation-duration": "3s",
                "animation-iteration-count": "infinite"
            })
        }, false);
        var formData = new FormData();

        formData.append("mediabundle_image[context]",$("#context").val());
        formData.append("mediabundle_image[filename]","");
        formData.append("mediabundle_image[targetId]",$("#target_id").val());
        formData.append("mediabundle_image[file]",file);

        xhr.send(formData);
    }else{
        statusLogo("Archivo Incorrecto o demasiado grande",1,destination);
    }

}
function statusLogo(message,display,width){
    $(".logoStatus").html(message);
    if(display==1){
        $(".logoStatus").fadeIn("fast");
    }else if(display===0){
        $(".logoStatus").fadeOut("fast");
    }
    if(width){
        $(".logoStatus").css("width",(32*width/100)+"%");
    }else{
        $(".logoStatus").css("width","auto");
    }
}


function galleryAction(gAction,gMethod,gObject,gParameters){
    console.log(gAction);
    $("#loading_wrap").show();
        $.ajax({
            type: gMethod,
            url: gAction,
            data: gParameters
            ,
            success : function(data, dataType)
            {
                $("#loading_wrap").hide();
                switch (gMethod){
                    case "DELETE" :
                        $(gObject).parents(".galleryContainer").css({
                            "animation-name": "fadeOutUp",
                            "animation-duration": "1s",
                            "animation-iteration-count": "1"
                        })
                        $(gObject).parents(".galleryContainer").one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
                            $(gObject).parents(".galleryContainer").remove();
                        });
                    break;

                }
            },
            error : function(data, dataType)
            {
                $("#loading_wrap").hide();
            }
        });
}
function initializeGalleryButtons(){
    $('#imageGallery a').unbind("click");
    $('#imageGallery a').click(function(event){
        event.preventDefault();
        event = event || window.event;
        options = {index: $('#imageGallery a').index( this ), event: event}
        links = $('#imageGallery a');
        blueimp.Gallery(links, options);
    });
    $('[gallery-action]').unbind("click");
    $('[gallery-action]').click(function(event){
        galleryAction($(this).attr("gallery-action"),$(this).attr("gallery-method"),$(this),$(this).find("input"));
    })
}
function persistImage(name){//Persists Images to database
    //console.log(window.numUploaded);
    $("#loading_wrap").show();
    $("span.btnSubmit").hide();
    $("img.loading-blue").show();
    $("button.btnSubmit").attr("class", "pull-right btnSubmit");
    routePost = routePost;
    mainHotelImage = 0;
	moveByName(name);
    $.ajax({
            type: "POST",
            url: routePost,
            data: {
                    name:name,
                    description:name,
                    main: mainHotelImage,
                    hotel: id_hotel

            },
        success: function(data, dataType)
        {

            //alertify.success("Imagen "+name+" persistida correctamente!");

            window.images[Number(window.images.length)]=data.id;

            $("[title='"+name+"']").attr("image_id",data.id);
            console.log(data.id+" assigned");

            $("[title='"+name+"']").parent().parent().find(".imgGallery").addClass("image_id");

            //moveToHotels(data.id);
            $("#HotelArea").show("fast");


            $("[title='"+name+"']").siblings(".delete").click(function(){
                deleteImage(data.id)
            });

            window.numUploaded--;
            if(window.numUploaded<1){
                loadStep();
                alertify.success("Imágenes subidas correctamente!");

            }else{
                console.log(window.numUploaded+" steps remaining");
            }
            $("span.btnSubmit").show();
            $("#loading_wrap").hide();

            $("img.loading-blue").hide();
        },
        error: function(XMLHttpRequest, textStatus, errorThrown)
        {
            //alertify.error("No fue posible subir la imagen " + i + "," + val + " !")
            $("[title='"+name+"']").css("border-color","#f00");
            $("#loading_wrap").hide();
            //moveToOrigin(name);
            return false;
        }
    });
//console.log("per");
}