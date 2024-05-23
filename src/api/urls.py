from django.urls import path

from .views import PostList, PostDetail,CommentaireList,CommentaireDetail,ZoneDetail,ZoneList

urlpatterns = [
    path("posts/", PostList.as_view()),
    path("posts/<int:pk>", PostDetail.as_view()),
    path("commentaires/", CommentaireList.as_view()),
    path("commentaires/<int:pk>", CommentaireDetail.as_view()),
    path("zones/", ZoneList.as_view()),
    path("zones/<int:pk>", ZoneDetail.as_view()),
]
