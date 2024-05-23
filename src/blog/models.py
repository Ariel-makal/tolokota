from django.db import models
from  authenticate.models import User
# Create your models here.


class Zone(models.Model):
    label = models.TextField()
    perimeters = models.CharField(max_length=50, blank=True,null=True)
    
    def __str__(self):
        return self.label
    
    class Meta:
        verbose_name = 'Zone'
        verbose_name_plural = 'Zones'
    
class Post(models.Model):
    user = models.ForeignKey(User, null=True, on_delete=models.CASCADE)
    image = models.ImageField()
    description = models.TextField(null=True, blank=True)
    latitude = models.CharField(max_length=50, null=True)
    longitude = models.CharField(max_length=50, null=True)
    createdAt = models.DateField(auto_now=False, auto_now_add=False)
    zone = models.ForeignKey( Zone,on_delete=models.CASCADE,null=True)

    def __str__(self):
        return self.description

    class Meta:
        verbose_name = 'Post'
        verbose_name_plural = 'Posts'
        
class Commentaire(models.Model):
    post = models.ForeignKey(Post,null=True,on_delete=models.CASCADE)
    user = models.ForeignKey(User,null=True,on_delete=models.CASCADE)
    createdAt = models.DateField(auto_now=False, auto_now_add=False)
    contenu = models.TextField()
    
    def __str__(self):
        return self.contenu

    class Meta:
        verbose_name = 'Commentaire'
        verbose_name_plural = 'Commentaires'