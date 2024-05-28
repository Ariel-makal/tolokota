
// GET POST
$.ajax({

    url: "http://localhost:8000/api/posts?order[createdAt]=desc",
    type: "get",
    headers: {
        "accept": "application/json"
    },
    success: function (res) {
        console.log(res)
        let feeds = ""
        res.forEach(post => {
            feeds += feedTemplate(post);
        });

        $('#section-feeds').html(feeds);
    },
    error: function (error) {
        console.log(error)
    }

});

//POST TEMPLATE
function feedTemplate(_post) {
    let html = ` 
    <div class="row p-3">
        <div class="card p-3 border-light" style="border-radius: 20px">
            <div class="cadr-body service">
                <div class="d-flex justify-content-between mb-3">
                    <div>
                        <span class="me-3 fw-bold text-dark">${_post.owner.nom}</span>.
                        <span class="ms-3">@${_post.owner.pseudo}</span>
                    </div>
                    <div>
                       <span style="font-size: 9pt">Depuis 
                    `;
                        if(moment().diff(moment(_post.createdAt), 'years') > 0) {
                            html += `${moment().diff(moment(_post.createdAt), 'years')} ans`
                        }
                        else if (moment().diff(moment(_post.createdAt), 'months') > 0)
                        {
                            html += `${moment().diff(moment(_post.createdAt), 'months')} mois`
                        }
                        else if (moment().diff(moment(_post.createdAt), 'weeks') > 0)
                        {
                            html += `${moment().diff(moment(_post.createdAt), 'weeks')} sem.`
                        }
                        else if (moment().diff(moment(_post.createdAt), 'days') > 0)
                        {
                            html += `${moment().diff(moment(_post.createdAt), 'days')} jrs.`
                        }
                        else if (moment().diff(moment(_post.createdAt), 'hours') > 0)
                        {
                            html += `${moment().diff(moment(_post.createdAt), 'hours')} h.`
                        }
                        else if (moment().diff(moment(_post.createdAt), 'minutes') > 0)
                        {
                            html += `${moment().diff(moment(_post.createdAt), 'minutes')} min.`
                        }
                        else if (moment().diff(moment(_post.createdAt), 'seconds') > 0)
                        {
                            html += `${moment().diff(moment(_post.createdAt), 'seconds')} sec.`
                        }
               html+= `</span>
                   </div>
                </div>
                <div class="mb-3">${_post.description}</div>
                <div class="col-12 service-item mb-3">
                    <img class="w-100" loading="lazy" src="${_post.image}" alt="" height="300" style="border-radius: 15px;object-fit: fill">
                </div>
                <div class="col-12">
                    <button class="btn btn-sm btn-outline-dark" style="border-radius: 15px">
                        <i class="fas fa-comment"></i> Commentaire ( ${_post.comments.length} )
                    </button>
                </div>
            </div>
        </div>
    </div>`;
return html;
}

//HTML GEO LOC.
const x = document.getElementById("demo");

// FUNCTION LOC.
getLocation()

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}

function showPosition(position) {
    $('input[name="latitude"]').val(position.coords.latitude) // PASS COORD. IN FIELD LAT
    $('input[name="longitude"]').val(position.coords.longitude) //PASs coord. in field long.
    x.innerHTML = position.coords.latitude + " , " + position.coords.longitude;
}
