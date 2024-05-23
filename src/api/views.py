from rest_framework import generics

from blog.models import Post,Commentaire,Zone
from .serializers import PostSerializer,CommentaireSerializer,ZoneSerializer

# Create your views here.

class PostList(generics.ListCreateAPIView):
    queryset = Post.objects.all()
    serializer_class = PostSerializer

class PostDetail(generics.RetrieveUpdateDestroyAPIView):
    queryset = Post.objects.all()
    serializer_class = PostSerializer
    
    
class CommentaireList(generics.ListCreateAPIView):
    queryset = Commentaire.objects.all()
    serializer_class = CommentaireSerializer

class CommentaireDetail(generics.RetrieveUpdateDestroyAPIView):
    queryset = Commentaire.objects.all()
    serializer_class = CommentaireSerializer
    
class ZoneList(generics.ListCreateAPIView):
    queryset = Zone.objects.all()
    serializer_class = ZoneSerializer
    
class ZoneDetail(generics.RetrieveUpdateDestroyAPIView):
    queryset = Zone.objects.all()
    serializer_class = ZoneSerializer