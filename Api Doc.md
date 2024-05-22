## Posts
## Récupérer la liste de tous les posts

### Requête

`GET /api/posts`

    URL :  NOM_DE_DOMAINE/posts/
    Body :  None

### Réponse
    
    Statut : 200 OK
    Body :  [
    {
        "id": 1,
        "user": 1,
        "image": "http://127.0.0.1:8000/icon_HtK4W0U.png",
        "description": "desc",
        "latitude": "latitude",
        "longitude": "longitude",
        "createdAt": "2024-05-21"
    }
]

## Ajouter un post

### Requête

`POST /api/posts`

    URL :  NOM_DE_DOMAINE/posts/
    Body :  {
    "id",
    "user",
    "createdAt"
}

### Réponse
    
    Statut : 200 OK
    Body : None    



## Récupérer les infos d'un seul post

### Requête

`GET /api/posts/<id_du_post>`

    URL :  NOM_DE_DOMAINE/posts/1
    Body :  None

### Réponse
    
    Statut : 200 OK
    Body : {
        "id": 1,
        "user": 1,
        "image": "http://127.0.0.1:8000/icon_HtK4W0U.png",
        "description": "desc",
        "latitude": "latitude",
        "longitude": "longitude",
        "createdAt": "2024-05-21"
    }
