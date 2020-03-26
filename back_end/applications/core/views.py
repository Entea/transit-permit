from drf_yasg import openapi
from drf_yasg.utils import swagger_auto_schema
from drf_yasg.views import get_schema_view
from rest_framework.generics import CreateAPIView
from rest_framework.response import Response
from rest_framework import permissions, status

from applications.core.serializers import ApplicationSerializer

schema_view = get_schema_view(
    openapi.Info(
        title='Transit Permit API', default_version='v1',
        description='Transit Permit API',
        terms_of_service='https://transit-permit.kg/policies/terms/',
        contact=openapi.Contact(email='admin@transit-permit.com'),
        license=openapi.License(name='BSD License'),
    ),
    public=True,
    permission_classes=(permissions.AllowAny, ),
)


class ApplicationAPIView(CreateAPIView):
    @swagger_auto_schema(
        request_body=ApplicationSerializer,
        operation_description='Submit application request',
        responses={
            200: 'Application request has been successfully submited',
            400: 'Bad request',
        },
    )
    def post(self, request, *args, **kwargs):
        serializer = ApplicationSerializer(data=request.data)
        if serializer.is_valid():
            self.perform_create(serializer)
            return Response(serializer.data)
        return Response({'detail': serializer.errors}, status=status.HTTP_400_BAD_REQUEST)
