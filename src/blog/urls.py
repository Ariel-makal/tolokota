from django.urls import path , include
from . import views

urlpatterns = [
    path('', views.home, name='home'),
    path('blog/',views.blog, name='blog'),
    path("about/",views.about, name="about"),
    path("maps/", views.maps, name="maps"),

]
