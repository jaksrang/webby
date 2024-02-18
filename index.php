;Prepare our WinHttpRequest object
HttpObj := ComObjCreate("WinHttp.WinHttpRequest.5.1")
;HttpObj.SetProxy(2,"localhost:8888") ;Send data through Fiddler (for debugging)
HttpObj.SetTimeouts(6000,6000,6000,6000) ;Set timeouts to 6 seconds
;HttpObj.Option(6) := False ;disable location-header rediects

;Set our URLs
registrationURL := "https://cricaza.com"

;Set our registration data
username := "Samah"
email := "myEmail@foo.bar"
password := "mySecretPassword"
acceptTOS := 1
receiveNewsLetter := 0

registrationBody := "username=" username "&email=" email "&repeatEmail=" email "&password=" password "&repeatPassword=" password "&TOSagree=" acceptTOS "&weeklyNewsLetter=" receiveNewsLetter

HttpObj.Open("POST",registrationURL)
HttpObj.SetRequestHeader("Content-Type","application/x-www-form-urlencoded")
HttpObj.Send(registrationBody)

If (HttpObj.status == 200 && InStr(HttpObj.ResponseText,"You will shortly receive an email with an activation link."))
    MsgBox, User successfully registered.
Else
    MsgBox, The registration failed!