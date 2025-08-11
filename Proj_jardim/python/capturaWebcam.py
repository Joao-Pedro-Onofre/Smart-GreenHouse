from importlib.resources import path
import cv2 as cv
#from datetime import datetime
#import os
import sys
import cv2
#import shutil
import requests
import time
from face_detection import crop_faces
import dlib
import face_recognition
from msvcrt import kbhit, getch
import winsound


def send_to_api(array):
    request = requests.post('http://proj_jardim.test/api/api.php', array)

    print(array)

    if(request.status_code == 200):
        print("O post foi realizado com sucesso, status code:", request.status_code)
        print(request.text)
    else:
        print("ERRO: Não foi possível realizar o pedido", request.status_code)


def playsound():
    winsound.PlaySound("porta.wav", winsound.SND_ALIAS)


try:
    while True:
        print("\n\n***NOVA CAPTURA DE IMAGEM *** : )")
        print("\nPrima CTRL+C na linha de comando para terminar o programa")

        # chama a funcao crop faces para detetar e recortar a cara depois de tirar a foto
        img = crop_faces()

        # liga a webcam e tira a foto quando se carregar no esc
        cv.imshow('Imagem', img)
        cv.waitKey(1000)
        cv.imwrite('faces.png', img)
        cv.destroyAllWindows()

        # vai buscar a imagem já existente, faz a deteção da cara, faz o encoding e aplica o retangulo
        imagem_conhecida = face_recognition.load_image_file('joao.png')
        imagem_conhecida = cv2.cvtColor(imagem_conhecida, cv2.COLOR_BGR2RGB)
        local_imagem_conhecida = face_recognition.face_locations(imagem_conhecida)[
            0]
        encode_imagem_conhecida = face_recognition.face_encodings(imagem_conhecida)[
            0]
        retangulo = cv2.rectangle(imagem_conhecida, (local_imagem_conhecida[3], local_imagem_conhecida[0]), (
            local_imagem_conhecida[1], local_imagem_conhecida[2]), (255, 0, 0), 2)

        # faz o mesmo que acima mas para a foto que acabou de tirar pela webcam
        imagem_camera = face_recognition.load_image_file('faces.png')
        imagem_camera = cv2.cvtColor(imagem_camera, cv2.COLOR_BGR2RGB)
        local_imagem_camera = face_recognition.face_locations(imagem_camera)[0]
        encode_imagem_camera = face_recognition.face_encodings(imagem_camera)[
            0]
        retangulo2 = cv2.rectangle(imagem_camera, (local_imagem_conhecida[3], local_imagem_conhecida[0]), (
            local_imagem_camera[1], local_imagem_camera[2]), (255, 0, 0), 2)

        # faz a comparação entre fotos para ver se é a mesma pessoa e devolve TRUE se for a mesma
        compara_imagens = face_recognition.compare_faces(
            [encode_imagem_conhecida], encode_imagem_camera)
        distancia_imagens = face_recognition.face_distance(
            [encode_imagem_conhecida], encode_imagem_camera)

        print(compara_imagens)

        # Se devolver TRUE manda o array com o estado da porta aberto, senao manda o estado fechado
        if(compara_imagens[0] == True):
            array = {'nome': 'atuador_porta_1', 'valor': 1, 'estado': 1}
            send_to_api(array)
        else:
            array = {'nome': 'atuador_porta_1', 'valor': 0, 'estado': 0}
            send_to_api(array)

        cv2.imshow('imagem_conhecida', retangulo)
        cv2.imshow('imagem_camera', retangulo2)
        cv2.waitKey(0)
        cv2.destroyAllWindows()

        time.sleep(5)
        # eu sei que nao está da melhor forma porque a ideia é ter separado noutro servidor ou computador, mas foi a solução que consegui.

except KeyboardInterrupt:       # CTRL+C para terminar
    print("Programa terminado pelo utilizador")
except:
    print("Ocorreu um erro: ", sys.exc_info())
finally:
    print("Fim do programa")
