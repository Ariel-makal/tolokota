from django.urls import path , include
from . import views

urlpatterns = [
    path('home/', views.home, name='home'),
    path('blog/',views.blog, name='blog'),
    path("about/",views.about, name="about"),
    path("maps/", views.maps, name="maps"),
    #path("sign-up/",views.signup, name="sign"),
    #path("login/",views.login, name="login")

]
