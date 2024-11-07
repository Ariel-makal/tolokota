
from django.urls import path , include
from . import views

urlpatterns = [
    path('Tolokota/contact-us', views.contact_view, name='contact'),
    path('confirmation/',views.confirmation_view, name='confirmation'),
]
