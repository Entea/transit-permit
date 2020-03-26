from django.urls import path

from applications.core.views import ApplicationAPIView


urlpatterns = [
    path('application/', ApplicationAPIView.as_view()),
]

