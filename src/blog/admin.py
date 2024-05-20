from django.contrib import admin
from blog.models import Commentaire,Post,Zone,User
# Register your models here.

admin.site.register(Commentaire)
admin.site.register(Post)
admin.site.register(User)
admin.site.register(Zone)