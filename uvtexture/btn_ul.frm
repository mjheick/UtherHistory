VERSION 5.00
Begin VB.Form frm_main 
   BorderStyle     =   0  'None
   Caption         =   "UVTexSync"
   ClientHeight    =   3255
   ClientLeft      =   -45
   ClientTop       =   -330
   ClientWidth     =   4800
   Icon            =   "btn_ul.frx":0000
   LinkTopic       =   "Form1"
   MaxButton       =   0   'False
   MinButton       =   0   'False
   ScaleHeight     =   3255
   ScaleWidth      =   4800
   ShowInTaskbar   =   0   'False
   StartUpPosition =   2  'CenterScreen
   Begin VB.Timer tmr_sync 
      Enabled         =   0   'False
      Interval        =   1000
      Left            =   720
      Top             =   1800
   End
   Begin VB.ListBox lst_status 
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   8.25
         Charset         =   0
         Weight          =   700
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   1035
      Left            =   120
      TabIndex        =   4
      Top             =   600
      Width           =   4575
   End
   Begin VB.CommandButton btn_ul 
      Caption         =   "¬"
      BeginProperty Font 
         Name            =   "Wingdings"
         Size            =   8.25
         Charset         =   2
         Weight          =   700
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   495
      Index           =   0
      Left            =   4440
      TabIndex        =   0
      ToolTipText     =   "Close"
      Top             =   0
      Width           =   375
   End
   Begin VB.CommandButton btn_ul 
      Caption         =   "â"
      BeginProperty Font 
         Name            =   "Wingdings"
         Size            =   8.25
         Charset         =   2
         Weight          =   700
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   495
      Index           =   1
      Left            =   4080
      TabIndex        =   1
      ToolTipText     =   "Minimize to Taskbar"
      Top             =   0
      Width           =   375
   End
   Begin VB.CommandButton btn_ul 
      Caption         =   "æ"
      BeginProperty Font 
         Name            =   "Wingdings"
         Size            =   8.25
         Charset         =   2
         Weight          =   700
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   495
      Index           =   2
      Left            =   3720
      TabIndex        =   2
      ToolTipText     =   "Minimize to System Tray"
      Top             =   0
      Width           =   375
   End
   Begin VB.Line Line1 
      X1              =   0
      X2              =   5520
      Y1              =   480
      Y2              =   480
   End
   Begin VB.Label Label1 
      Caption         =   "UtherVerse TEXture SYNChronizer"
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   8.25
         Charset         =   0
         Weight          =   700
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   255
      Left            =   120
      TabIndex        =   3
      Top             =   120
      Width           =   3735
   End
End
Attribute VB_Name = "frm_main"
Attribute VB_GlobalNameSpace = False
Attribute VB_Creatable = False
Attribute VB_PredeclaredId = True
Attribute VB_Exposed = False
Option Explicit
' for moving application window
Private Declare Function ReleaseCapture Lib "user32" () As Long
Private Declare Function SendMessage Lib "user32" Alias "SendMessageA" (ByVal hWnd As Long, ByVal wMsg As Long, ByVal wParam As Long, lParam As Any) As Long
' for moving application to system tray
Private Declare Function Shell_NotifyIcon Lib "shell32" Alias "Shell_NotifyIconA" (ByVal Message As Long, Data As NotifyIconData) As Boolean
Private Type NotifyIconData ' Type passed to Shell_NotifyIcon
  Size As Long
  Handle As Long
  ID As Long
  Flags As Long
  CallBackMessage As Long
  Icon As Long
  Tip As String * 64
End Type
Private Const AddIcon = &H0
Private Const ModifyIcon = &H1
Private Const DeleteIcon = &H2
Private Const WM_MOUSEMOVE = &H200
Private Const WM_LBUTTONDBLCLK = &H203
Private Const WM_LBUTTONDOWN = &H201
Private Const WM_LBUTTONUP = &H202
Private Const WM_RBUTTONDBLCLK = &H206
Private Const WM_RBUTTONDOWN = &H204
Private Const WM_RBUTTONUP = &H205
Private Const MessageFlag = &H1
Private Const IconFlag = &H2
Private Const TipFlag = &H4
Private vbShellIconData As NotifyIconData

Dim DoStatusCheck As Long

Private Sub btn_ul_Click(Index As Integer)
Dim vbResult As VbMsgBoxResult
Select Case Index
    Case 0: ' close
        vbResult = MsgBox("Are you sure you want to exit?", vbYesNo, "Exit Application")
        If vbResult = vbYes Then
            DeleteIconFromTray
            End
        End If
    Case 1: ' to taskbar
        frm_main.WindowState = 1
    Case 2: ' to tray
        frm_main.Visible = False
        AddIconToTray
End Select
End Sub

Private Sub Form_Activate()
lst_status.SetFocus
TextureCheckup
DoStatusCheck = Int(Rnd * 240) + 3360
tmr_sync.Interval = 1000
tmr_sync.Enabled = True
End Sub

Private Sub Form_Load()
On Local Error Resume Next
Randomize Timer
Dim Bypass As Boolean

' set application path and Utherverse paths, moved for debug
If Mid(App.Path, Len(App.Path), 1) = "\" Then
    aPath = App.Path
Else
    aPath = App.Path & "\"
End If
Kill aPath & "debuglog.txt"
DoDebug "Starting UVTexSync"
DoDebug "Application Path: " & aPath
Bypass = True
If Not Bypass Then
    uvPath = GetInstallDir()
    If uvPath = "" Then
        MsgBox "Utherverse/VirtualVancouver/Rude client is not found.", , "Error"
        End
    End If
    If App.PrevInstance = True Then
        MsgBox "You are already running this application.", , "Error"
        End
    End If
End If

' prepare 5 slots for usage
lst_status.AddItem "": lst_status.AddItem "": lst_status.AddItem "": lst_status.AddItem "": lst_status.AddItem ""
' visual prowess
frm_main.Height = 1725

If Mid(uvPath, Len(uvPath), 1) <> "\" Then
    uvPath = uvPath & "\"
End If
DoDebug "Texture root path: " & uvPath
End Sub

Private Sub Form_MouseDown(Button As Integer, Shift As Integer, X As Single, Y As Single)
MoveApplicationWindow
End Sub

Private Sub Label1_MouseDown(Button As Integer, Shift As Integer, X As Single, Y As Single)
MoveApplicationWindow
End Sub

Private Sub MoveApplicationWindow()
' to be declared
'Private Declare Function ReleaseCapture Lib "user32" () As Long
'Private Declare Function SendMessage Lib "user32" Alias "SendMessageA" (ByVal hwnd As Long, ByVal wMsg As Long, ByVal wParam As Long, lParam As Any) As Long
Const WM_NCLBUTTONDOWN = &HA1
Const HTCAPTION = 2
Call ReleaseCapture
Call SendMessage(frm_main.hWnd, WM_NCLBUTTONDOWN, HTCAPTION, 0)
End Sub

Private Sub AddIconToTray()
vbShellIconData.Size = Len(vbShellIconData)
vbShellIconData.Handle = frm_main.hWnd
vbShellIconData.ID = vbNull
vbShellIconData.Flags = IconFlag Or TipFlag Or MessageFlag
vbShellIconData.CallBackMessage = WM_MOUSEMOVE
vbShellIconData.Icon = frm_main.Icon
vbShellIconData.Tip = "UVTexSync" & vbNullChar
Call Shell_NotifyIcon(AddIcon, vbShellIconData)
End Sub

Private Sub DeleteIconFromTray()
Call Shell_NotifyIcon(DeleteIcon, vbShellIconData)
End Sub

Private Sub Form_MouseMove(Button As Integer, Shift As Integer, X As Single, Y As Single)
Dim Message As Long
Message = X / Screen.TwipsPerPixelX
Select Case Message
    Case WM_LBUTTONDBLCLK
        frm_main.Visible = True
        DeleteIconFromTray
End Select
End Sub

Private Sub lst_status_MouseUp(Button As Integer, Shift As Integer, X As Single, Y As Single)
PopupMenu frm_stuff.mnu_menu
End Sub

Private Sub tmr_sync_Timer()
If DoStatusCheck > 0 Then
    ' decrement status check
    DoStatusCheck = DoStatusCheck - 1
    ' update screen
    lst_status.List(0) = "Next checkup in " & DoStatusCheck & " secs"
    Exit Sub
Else
    ' timer=0
    TextureCheckup
End If

' end of routine
DoStatusCheck = Int(Rnd * 240) + 3360
End Sub

Private Sub TextureCheckup()
On Local Error Resume Next ' for timeouts
Dim RemoteData As String, LocalData As String
Dim TextMod As String, CurText As String, DLLocation As String, DLSize As Long
lst_status.List(0) = "Performing checkup..."
DoDebug "Exec TextureCheckup()"
Dim Web As Variant
Set Web = CreateObject("WinHttp.WinHttpRequest.5.1")
If Web Is Nothing Then Set Web = CreateObject("WinHttp.WinHttpRequest")
If Web Is Nothing Then Set Web = CreateObject("MSXML2.ServerXMLHTTP")
If Web Is Nothing Then Set Web = CreateObject("Microsoft.XMLHTTP")

If Web Is Nothing Then DoDebug "Error: No Web Object defined from winhttp.dll"

LocalData = "": Open aPath & "lmf.txt" For Input As #1: Input #1, LocalData: Close #1
RemoteData = "": Web.WaitForResponse 5: Web.Open "GET", "http://www.uvtexture.com/lastmod.php?var=lmf", False: Web.Send
If Trim(Web.Status) = "200" Then RemoteData = Web.ResponseText
DoDebug "localdata::lmf::" & LocalData & "/" & "::"
DoDebug "remotedata::lmf::" & RemoteData & "/" & Web.Status & "::"
If RemoteData <> LocalData Then ' download!
    lst_status.List(0) = "Downloading female textures" ' resources\female\textures
    TextMod = RemoteData
    ' grab texture list
    RemoteData = "": Web.WaitForResponse 5: Web.Open "GET", "http://www.uvtexture.com/texturelist.php?var=lmf", False: Web.Send
    If Trim(Web.Status) = "200" Then RemoteData = Web.ResponseText
    Open aPath & "textlist.txt" For Output As #1: Print #1, RemoteData: Close #1
    Open aPath & "Female_Textures.txt" For Output As #1: Print #1, RemoteData: Close #1
    Open aPath & "textlist.txt" For Input As #1
    While Not EOF(1)
        Line Input #1, CurText
        If Len(Trim(CurText)) > 0 Then
            If Len(Dir(uvPath & "resources\female\textures\" & CurText)) = 0 Then ' download
                DLLocation = "": Web.WaitForResponse 5: Web.Open "GET", "http://www.uvtexture.com/texturelist.php?var=lmf&tex=" & CurText, False: Web.Send
                If Trim(Web.Status) = "200" Then DLLocation = Web.ResponseText
                DLSize = 0: Web.WaitForResponse 5: Web.Open "GET", "http://www.uvtexture.com/texturesize.php?var=lmf&tex=" & CurText, False: Web.Send
                If Trim(Web.Status) = "200" Then DLSize = Val(Web.ResponseText)
                lst_status.List(2) = "Downloading texture..."
                lst_status.List(3) = "File: " & CurText
                lst_status.List(4) = "Size: " & DLSize
                DoEvents
                Web.WaitForResponse 5: Web.Open "GET", "http://www.uvtexture.com/" & DLLocation, False: Web.Send
                If Web.Status = "200" Then
                    Open uvPath & "resources\female\textures\" & CurText For Binary Access Write As #2
                    Put #2, , Web.ResponseBody()
                    Close #2
                    mod_uvtexture.DeleteData uvPath & "resources\female\textures\" & CurText, 1, 12
                End If
            End If
        End If
    Wend
    Close #1
    Open aPath & "lmf.txt" For Output As #1: Print #1, TextMod: Close #1
    lst_status.List(2) = "": lst_status.List(3) = "": lst_status.List(4) = ""
    lst_status.List(0) = "Performing checkup..."
End If

LocalData = "": Open aPath & "lmfa.txt" For Input As #1: Input #1, LocalData: Close #1
RemoteData = "": Web.WaitForResponse 5: Web.Open "GET", "http://www.uvtexture.com/lastmod.php?var=lmfa", False: Web.Send
If Trim(Web.Status) = "200" Then RemoteData = Web.ResponseText
DoDebug "localdata::lmfa::" & LocalData & "/" & "::"
DoDebug "remotedata::lmfa::" & RemoteData & "/" & Web.Status & "::"
If RemoteData <> LocalData Then ' download!
    lst_status.List(0) = "Downloading female attachment textures" ' resources\female\attachments\textures
    TextMod = RemoteData
    ' grab texture list
    RemoteData = "": Web.WaitForResponse 5: Web.Open "GET", "http://www.uvtexture.com/texturelist.php?var=lmfa", False: Web.Send
    If Trim(Web.Status) = "200" Then RemoteData = Web.ResponseText
    Open aPath & "textlist.txt" For Output As #1: Print #1, RemoteData: Close #1
    Open aPath & "Female_Texture_Attachments.txt" For Output As #1: Print #1, RemoteData: Close #1
    Open aPath & "textlist.txt" For Input As #1
    While Not EOF(1)
        Line Input #1, CurText
        If Len(Trim(CurText)) > 0 Then
            If Len(Dir(uvPath & "resources\female\attachments\textures\" & CurText)) = 0 Then ' download
                DLLocation = "": Web.WaitForResponse 5: Web.Open "GET", "http://www.uvtexture.com/texturelist.php?var=lmfa&tex=" & CurText, False: Web.Send
                If Trim(Web.Status) = "200" Then DLLocation = Web.ResponseText
                DLSize = 0: Web.WaitForResponse 5: Web.Open "GET", "http://www.uvtexture.com/texturesize.php?var=lmfa&tex=" & CurText, False: Web.Send
                If Trim(Web.Status) = "200" Then DLSize = Val(Web.ResponseText)
                lst_status.List(2) = "Downloading texture..."
                lst_status.List(3) = "File: " & CurText
                lst_status.List(4) = "Size: " & DLSize
                DoEvents
                Web.WaitForResponse 5: Web.Open "GET", "http://www.uvtexture.com/" & DLLocation, False: Web.Send
                If Web.Status = "200" Then
                    Open uvPath & "resources\female\attachments\textures\" & CurText For Binary Access Write As #2
                    Put #2, , Web.ResponseBody()
                    Close #2
                    mod_uvtexture.DeleteData uvPath & "resources\female\attachments\textures\" & CurText, 1, 12
                End If
            End If
        End If
    Wend
    Close #1
    Open aPath & "lmfa.txt" For Output As #1: Print #1, TextMod: Close #1
    lst_status.List(2) = "": lst_status.List(3) = "": lst_status.List(4) = ""
    lst_status.List(0) = "Performing checkup..."
End If

LocalData = "": Open aPath & "lmm.txt" For Input As #1: Input #1, LocalData: Close #1
RemoteData = "": Web.WaitForResponse 5: Web.Open "GET", "http://www.uvtexture.com/lastmod.php?var=lmm", False: Web.Send
If Trim(Web.Status) = "200" Then RemoteData = Web.ResponseText
DoDebug "localdata::lmm::" & LocalData & "/" & "::"
DoDebug "remotedata::lmm::" & RemoteData & "/" & Web.Status & "::"
If RemoteData <> LocalData Then ' download!
    lst_status.List(0) = "Downloading male textures" ' resources\male\textures
    TextMod = RemoteData
    ' grab texture list
    RemoteData = "": Web.WaitForResponse 5: Web.Open "GET", "http://www.uvtexture.com/texturelist.php?var=lmm", False: Web.Send
    If Trim(Web.Status) = "200" Then RemoteData = Web.ResponseText
    Open aPath & "textlist.txt" For Output As #1: Print #1, RemoteData: Close #1
    Open aPath & "Male_Textures.txt" For Output As #1: Print #1, RemoteData: Close #1
    Open aPath & "textlist.txt" For Input As #1
    While Not EOF(1)
        Line Input #1, CurText
        If Len(Trim(CurText)) > 0 Then
            If Len(Dir(uvPath & "resources\male\textures\" & CurText)) = 0 Then ' download
                DLLocation = "": Web.WaitForResponse 5: Web.Open "GET", "http://www.uvtexture.com/texturelist.php?var=lmm&tex=" & CurText, False: Web.Send
                If Trim(Web.Status) = "200" Then DLLocation = Web.ResponseText
                DLSize = 0: Web.WaitForResponse 5: Web.Open "GET", "http://www.uvtexture.com/texturesize.php?var=lmm&tex=" & CurText, False: Web.Send
                If Trim(Web.Status) = "200" Then DLSize = Val(Web.ResponseText)
                lst_status.List(2) = "Downloading texture..."
                lst_status.List(3) = "File: " & CurText
                lst_status.List(4) = "Size: " & DLSize
                DoEvents
                Web.WaitForResponse 5: Web.Open "GET", "http://www.uvtexture.com/" & DLLocation, False: Web.Send
                If Web.Status = "200" Then
                    Open uvPath & "resources\male\textures\" & CurText For Binary Access Write As #2
                    Put #2, , Web.ResponseBody()
                    Close #2
                    mod_uvtexture.DeleteData uvPath & "resources\male\textures\" & CurText, 1, 12
                End If
            End If
        End If
    Wend
    Close #1
    Open aPath & "lmm.txt" For Output As #1: Print #1, TextMod: Close #1
    lst_status.List(2) = "": lst_status.List(3) = "": lst_status.List(4) = ""
    lst_status.List(0) = "Performing checkup..."
End If

LocalData = "": Open aPath & "lmma.txt" For Input As #1: Input #1, LocalData: Close #1
RemoteData = "": Web.WaitForResponse 5: Web.Open "GET", "http://www.uvtexture.com/lastmod.php?var=lmma", False: Web.Send
If Trim(Web.Status) = "200" Then RemoteData = Web.ResponseText
DoDebug "localdata::lmma::" & LocalData & "/" & "::"
DoDebug "remotedata::lmma::" & RemoteData & "/" & Web.Status & "::"
If RemoteData <> LocalData Then ' download!
    lst_status.List(0) = "Downloading male attachment textures" ' male\attachments\textures
    TextMod = RemoteData
    ' grab texture list
    RemoteData = "": Web.WaitForResponse 5: Web.Open "GET", "http://www.uvtexture.com/texturelist.php?var=lmma", False: Web.Send
    If Trim(Web.Status) = "200" Then RemoteData = Web.ResponseText
    Open aPath & "textlist.txt" For Output As #1: Print #1, RemoteData: Close #1
    Open aPath & "Male_Texture_Attachments.txt" For Output As #1: Print #1, RemoteData: Close #1
    Open aPath & "textlist.txt" For Input As #1
    While Not EOF(1)
        Line Input #1, CurText
        If Len(Trim(CurText)) > 0 Then
            If Len(Dir(uvPath & "resources\male\attachments\textures\" & CurText)) = 0 Then ' download
                DLLocation = "": Web.WaitForResponse 5: Web.Open "GET", "http://www.uvtexture.com/texturelist.php?var=lmma&tex=" & CurText, False: Web.Send
                If Trim(Web.Status) = "200" Then DLLocation = Web.ResponseText
                DLSize = 0: Web.WaitForResponse 5: Web.Open "GET", "http://www.uvtexture.com/texturesize.php?var=lmma&tex=" & CurText, False: Web.Send
                If Trim(Web.Status) = "200" Then DLSize = Val(Web.ResponseText)
                lst_status.List(2) = "Downloading texture..."
                lst_status.List(3) = "File: " & CurText
                lst_status.List(4) = "Size: " & DLSize
                DoEvents
                Web.WaitForResponse 5: Web.Open "GET", "http://www.uvtexture.com/" & DLLocation, False: Web.Send
                If Web.Status = "200" Then
                    Open uvPath & "resources\male\attachments\textures\" & CurText For Binary Access Write As #2
                    Put #2, , Web.ResponseBody()
                    Close #2
                    mod_uvtexture.DeleteData uvPath & "resources\male\attachments\textures\" & CurText, 1, 12
                End If
            End If
        End If
    Wend
    Close #1
    Open aPath & "lmma.txt" For Output As #1: Print #1, TextMod: Close #1
    lst_status.List(2) = "": lst_status.List(3) = "": lst_status.List(4) = ""
    lst_status.List(0) = "Performing checkup..."
End If

End Sub
