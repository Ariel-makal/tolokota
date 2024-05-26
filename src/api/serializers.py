from rest_framework import serializers

from blog.models import Post, Zone, Commentaire
from authenticate.models import User
class PostSerializer(serializers.ModelSerializer):
    class Meta:
        model = Post
        fields = ('id','user', 'image', 'description', 'latitude', 'longitude', 'createdAt')
        

class ZoneSerializer(serializers.ModelSerializer):
    class Meta:
        model = Zone
        fields = ('id','label','perimeters')
        
class CommentaireSerializer(serializers.ModelSerializer):
    class Meta:
        model = Commentaire
        fields = ('id','user', 'post', 'contenu', 'createdAt')
        
class UserSerializer(serializers.ModelSerializer):
    class Meta:
        model = User
        fields = ('id','username', 'email', 'password','commune','quartier')