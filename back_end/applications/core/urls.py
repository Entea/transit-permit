from django.urls import path

from applications.core.views import (
    ApplicationAPIView,
    ApplicationRetrieveAPIView,
    ApplicationSingleAPIView
)

urlpatterns = [
    path('application/', ApplicationAPIView.as_view()),
    path('application/<str:uid>/', ApplicationRetrieveAPIView.as_view()),
    path('single-application/', ApplicationSingleAPIView.as_view())
]

