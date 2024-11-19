from django.shortcuts import render

# Create your views here.
def home(request):
    return render(request, "home/home.html")
def blog(request):
    if request.method == 'POST':
        description = request.POST.get('description')
        print(description)
    return render(request, "html/blog.html")
def about(request):
    return render(request, "html/about.html")
def maps(request):
    return render(request, "html/maps.html")
