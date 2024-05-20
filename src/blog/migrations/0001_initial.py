# Generated by Django 5.0.6 on 2024-05-20 12:02

from django.conf import settings
from django.db import migrations, models


class Migration(migrations.Migration):

    initial = True

    dependencies = [
        migrations.swappable_dependency(settings.AUTH_USER_MODEL),
    ]

    operations = [
        migrations.CreateModel(
            name="Zone",
            fields=[
                (
                    "id",
                    models.BigAutoField(
                        auto_created=True,
                        primary_key=True,
                        serialize=False,
                        verbose_name="ID",
                    ),
                ),
                ("label", models.TextField()),
                ("perimeters", models.CharField(blank=True, max_length=50, null=True)),
            ],
            options={
                "verbose_name": "Zone",
                "verbose_name_plural": "Zones",
            },
        ),
        migrations.CreateModel(
            name="Post",
            fields=[
                (
                    "id",
                    models.BigAutoField(
                        auto_created=True,
                        primary_key=True,
                        serialize=False,
                        verbose_name="ID",
                    ),
                ),
                ("image", models.ImageField(upload_to="")),
                ("description", models.TextField(blank=True, null=True)),
                ("latitude", models.CharField(max_length=50, null=True)),
                ("longitude", models.CharField(max_length=50, null=True)),
                ("commenters", models.TextField(blank=True, null=True)),
                ("createdAt", models.DateField()),
                (
                    "user",
                    models.ManyToManyField(null=True, to=settings.AUTH_USER_MODEL),
                ),
            ],
            options={
                "verbose_name": "Post",
                "verbose_name_plural": "Posts",
            },
        ),
        migrations.CreateModel(
            name="Commentaire",
            fields=[
                (
                    "id",
                    models.BigAutoField(
                        auto_created=True,
                        primary_key=True,
                        serialize=False,
                        verbose_name="ID",
                    ),
                ),
                ("createdAt", models.DateField()),
                ("contenu", models.TextField()),
                (
                    "user",
                    models.ManyToManyField(null=True, to=settings.AUTH_USER_MODEL),
                ),
                (
                    "post",
                    models.ManyToManyField(
                        null=True, to="blog.post", verbose_name="Son post"
                    ),
                ),
            ],
            options={
                "verbose_name": "Commentaire",
                "verbose_name_plural": "Commentaires",
            },
        ),
    ]
