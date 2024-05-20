from django.db import models
from  authenticate.models import User
# Create your models here.

class Post(models.Model):
    user = models.ManyToManyField(User,null=True)
    image = models.ImageField()
    description = models.TextField(null=True, blank=True)
    latitude = models.CharField(max_length=50, null=True)
    longitude = models.CharField(max_length=50, null=True)
    commenters = models.TextField(null=True, blank=True)
    createdAt = models.DateField(auto_now=False, auto_now_add=False)

    def __str__(self):
        self.user

    class Meta:
        verbose_name = 'Post'
        verbose_name_plural = 'Posts'
        
class Commentaire(models.Model):
    post = models.ManyToManyField(Post, verbose_name=("Son post"),null=True)
    user = models.ManyToManyField(User,null=True)
    createdAt = models.DateField(auto_now=False, auto_now_add=False)
    contenu = models.TextField()
    
    def __str__(self):
        pass

    class Meta:
        verbose_name = 'Commentaire'
        verbose_name_plural = 'Commentaires'
    
class Zone(models.Model):
    label = models.TextField()
    perimeters = models.CharField(max_length=50, blank=True,null=True)
    
    def __str__(self):
        return self.label
    
    class Meta:
        verbose_name = 'Zone'
        verbose_name_plural = 'Zones'
    
    