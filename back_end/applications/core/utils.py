import os
import pyqrcode

from django.conf import settings


# generate_qrcode(a.application_link, f'{a.uid}.png', 10)
def generate_qrcode(text, filename, scale=10):
    os.chdir(settings.MEDIA_ROOT)
    if not os.path.isdir('./qr_codes'):
        os.mkdir('qr_codes')

    os.chdir('qr_codes/')

    if not os.path.isfile(f'./{filename}'):
        qr = pyqrcode.create(text)
        qr.png(filename, scale)

    return f'{settings.HOSTNAME}/media/qr_codes/{filename}'
