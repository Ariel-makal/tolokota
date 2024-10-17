from django.urls import path , include
from . import views

urlpatterns = [
    path('home/', views.home, name='home'),
    path('blog/',views.blog, name='blog'),
    path("about/",views.about, name="about"),
    path("maps/", views.maps, name="maps"),
    #path('login/', views.login, name='login'),
    #path('signup/', views.user_signup, name='signup'),
    #path('logout/', views.user_logout, name='logout'),
]
