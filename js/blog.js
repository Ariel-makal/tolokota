
console.log("ok")
$.ajax({

    url:"https://3ff5-2c0f-e00-640-8700-409a-2e2c-2794-dbbe.ngrok-free.app/api/posts",
    type:"get",
    headers:{
        "ngrok-skip-browser-warning":true
    },
    success:function(response){
        console.log(response)
        let feeds = "";
        response.forEach(element => {
            console.log(element);
            feeds = feeds+feedTemplate(element)

        });
        $("#section-feeds").html(feeds)
    },
    error:function(error){console.log(error)}

})


function feedTemplate(data){
    
    return html=` 
    <div class="row">
        <div class="col-1 ">
            <img class=" rounded" src="${data.image}" alt="" style="width:60px; height:60px">
        </div>
        <div class="col-11 px-3">
            <p class="py-2  w-50 mb-3 mt-2" >${data.user}</p>
            <p class="py-2  w-100"  >${data.description}</p>
        </div>
    </div>`
}