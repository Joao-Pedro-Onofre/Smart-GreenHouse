import sys
import requests
import time
from msvcrt import kbhit, getch
import winsound


def playsound(var):
    if var == 1:
        winsound.PlaySound("porta.wav", winsound.SND_ALIAS)
    elif var == 2:
        winsound.PlaySound("Alarm.wav", winsound.SND_ALIAS)


def send_to_api(array):
    request = requests.post('http://proj_jardim.test/api/api.php', array)
    print(request)

    print(array)

    if(request.status_code == 200):
        print("O post foi realizado com sucesso, status code:", request.status_code)
        print(request.text)
    else:
        print("ERRO: Não foi possível realizar o pedido", request.status_code)


try:
    while True:
        # LIGAR E DESLIGAR O LED DA CAMERA MANUALMENTE (python -> CPT)
        if kbhit():

            valor = getch()
            # se o input do terminal for 0
            if valor == b"0":
                # enviar para a API um POST com a info do atuador com o estado a 0 (fechado)
                array = {'nome': 'atuador_luz_camera',
                         'valor': 0, 'tipo_disp': 2, 'estado': 0}
                send_to_api(array)
                print("\n Flash da camera desligado")

            # se o input do terminal for 1
            elif valor == b"1":
                # enviar para a API um POST com a info do atuador com o estado a 1 (aberto)
                array = {'nome': 'atuador_luz_camera',
                         'valor': 0, 'tipo_disp': 2, 'estado': 1}
                send_to_api(array)
                print("\n Flash da camera ligado")

            else:
                print("opção inválida")

        # TOCA SE CHEGAR A UMA TEMPERATURA ACIMA DE 20ºC
        # faz o get do sensor de temperatura
        r = requests.get(
            'http://proj_jardim.test/api/api.php?nome=sensor_temperatura_1')
        # passa a var r para string e de pos dá split para transformar em array
        array_temp = (r.text).split()
        # converte a posição do array em int
        valor_temp = float(array_temp[1])

        # serve para identificar de onde chama para depois usar o playsound
        var = 2

        # se fizer o get como deve ser entra no if
        if(r.status_code == 200):
            print("Valor da temperatura:", valor_temp)
            # se for maior que 30, devolve o valor e ativa o alerta sonoro
            if(valor_temp > 30):
                print("Temperatura HIGH:", valor_temp)
                playsound(var)
            # senao devolve so a mensagem no terminal
            else:
                print("Temperatura LOW", valor_temp)
        else:
            print("O pedido HTTP nao foi bem recebido")

        # TOCA SE SE ALTERAR NA DASHBOARD (Dash -> Python)
        # faz a mesma coisa que acima, o get, convert para string, depois para array, depois para int
        r = requests.get(
            'http://proj_jardim.test/api/api.php?nome=atuador_porta_1')
        array_porta = (r.text).split()
        valor_porta = int(array_porta[2])

        # se a porta tiver aberta devolve uma mensagem e um alerta sonoro, senao devolve outra
        if(valor_porta == 1):
            print("\nPorta: Aberta")
            playsound(valor_porta)
        else:
            print("\nPorta: Fechada")

        time.sleep(1)


except KeyboardInterrupt:       # CTRL+C para terminar
    print("Programa terminado pelo utilizador")
except:
    print("Ocorreu um erro: ", sys.exc_info())
finally:
    print("Fim do programa")


# dica do stor:
