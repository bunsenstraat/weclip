/**
 * CodeDropz Uploader v1.0
 * Copyright 2018 Glen Mongaya
 * CodeDrop Drag&Drop Uploader
 * @version 1.0
 * @author CodeDropz, Glen Don L. Mongaya
 * @license The MIT License (MIT)
 */

// CodeDropz Drag and Drop Plugin
!function(e){e.fn.CodeDropz_Uploader=function(a){var d=e.extend({handler:this,color:"#000",background:"",server_max_error:"Uploaded file exceeds the maximum upload size of your server.",max_file:10,text:"Drag & Drop Files Here",separator:"or",button_text:"Browse Files",max_upload_size:"5242880",supported_type:"jpg|jpeg|png|gif|pdf|doc|docx|ppt|pptx|odt|avi|ogg|m4a|mov|mp3|mp4|mpg|wav|wmv",on_success:""},a),r=1,o='<div class="codedropz-upload-handler"><div class="codedropz-upload-container"><div class="codedropz-upload-inner"><h3>'+d.text+"</h3><span>"+d.separator+'</span><div class="codedropz-btn-wrap"><a class="cd-upload-btn" href="javascript:void(0)">'+d.button_text+"</a></div></div></div></div>";d.handler.wrapAll('<div class="codedropz-upload-wrapper"></div>');var n=d.handler.parents("form"),s=d.handler.parents(".codedropz-upload-wrapper");d.handler.after(o),e(".codedropz-upload-handler",s).on("drag dragstart dragend dragover dragenter dragleave drop",function(e){e.preventDefault(),e.stopPropagation()}),e(".codedropz-upload-handler",s).on("dragover dragenter",function(a){e(this).addClass("codedropz-dragover")}),e(".codedropz-upload-handler",s).on("dragleave dragend drop",function(a){e(this).removeClass("codedropz-dragover")}),e("a.cd-upload-btn",s).on("click",function(e){e.preventDefault(),d.handler.click()}),e(".codedropz-upload-handler",s).on("drop",function(e){p(e.originalEvent.dataTransfer.files,"drop"),d.handler.trigger("change")}),d.handler.on("change",function(e){p(this.files,"click")});var p=function(a,o){if(!(!a.length>1)){var p=new FormData;e.each(a,function(a,i){if(r>d.max_file)return!1;r++;var l,c,u,v,f,h=(l=i,c=e(".codedropz-upload-handler",s),u="dnd-file-"+Math.random().toString(36).substr(2,9),v='<div class="dnd-upload-image"><span class="dnd-icon-blank-file"></span></div><div class="dnd-upload-details"><span class="name">'+l.name+" <em>("+(0===(f=l.size)?"0":(kBytes=f/1024,fileSize=kBytes>=1024?(kBytes/1024).toFixed(2)+"MB":kBytes.toFixed(2)+"KB",fileSize))+')</em></span><a href="javascript:void(0)" title="Remove" class="remove-file"><span class="dnd-icon-remove"></span></a><span class="dnd-progress-bar"><span></span></span></div>',c.after('<div id="'+u+'" class="dnd-upload-status">'+v+"</div>"),u);p.append("upload-file",i),p.append("supported_type",d.supported_type),p.append("size_limit",d.max_upload_size),p.append("action","dnd_codedropz_upload"),p.append("type",o);e.ajax({url:d.ajax_url,type:n.attr("method"),data:p,dataType:"json",cache:!1,contentType:!1,processData:!1,xhr:function(){var e=new window.XMLHttpRequest;return e.upload.addEventListener("progress",function(e){if(e.lengthComputable){var a=e.loaded/e.total,d=parseInt(100*a);t(h,d)}},!1),e},complete:function(){t(h,100)},success:function(a){a.success?e.isFunction(d.on_success)&&d.on_success.call(this,h,a):(e(".dnd-progress-bar",e("#"+h)).remove(),e(".dnd-upload-details",e("#"+h)).append('<span class="has-error">'+a.data+"</span>"))},error:function(a,r,o){e(".dnd-progress-bar",e("#"+h)).remove(),e(".dnd-upload-details",e("#"+h)).append('<span class="has-error">'+d.server_max_error+"</span>")}})})}};function t(a,d){var r=e(".dnd-progress-bar",e("#"+a));return r.length>0&&(progress_width=d*r.width()/100,e("span",r).animate({width:progress_width},10).text(d+"% "),100==d&&e("span",r).addClass("complete")),!1}e(document).on("click",".dnd-icon-remove",function(){e(this).parents(".dnd-upload-status").remove(),r-=1})}}(jQuery);