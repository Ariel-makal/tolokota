from rest_framework import serializers

from blog.models import Post

class PostSerializer(serializers.ModelSerializer):
    class Meta:
        model = Post
        fields = ('user', 'image', 'description', 'latitude', 'longitude', 'createdAt')