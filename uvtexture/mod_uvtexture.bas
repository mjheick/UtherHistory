Attribute VB_Name = "mod_uvtexture"
Private Declare Function ShellExecute Lib "shell32.dll" Alias "ShellExecuteA" (ByVal hWnd As Long, ByVal lpOperation As String, ByVal lpFile As String, ByVal lpParameters As String, ByVal lpDirectory As String, ByVal nShowCmd As Long) As Long
Private Declare Function ShellExecuteForExplore Lib "shell32.dll" Alias "ShellExecuteA" (ByVal hWnd As Long, ByVal lpOperation As String, ByVal lpFile As String, lpParameters As Any, lpDirectory As Any, ByVal nShowCmd As Long) As Long
Private Declare Function RegOpenKeyEx Lib "advapi32.dll" Alias "RegOpenKeyExA" (ByVal hKey As Long, ByVal lpSubKey As String, ByVal ulOptions As Long, ByVal samDesired As Long, phkResult As Long) As Long
Private Declare Function RegCloseKey Lib "advapi32.dll" (ByVal hKey As Long) As Long
Private Declare Function RegCreateKey Lib "advapi32.dll" Alias "RegCreateKeyA" (ByVal hKey As Long, ByVal lpSubKey As String, phkResult As Long) As Long
Private Declare Function RegQueryValueExString Lib "advapi32.dll" Alias "RegQueryValueExA" (ByVal hKey As Long, ByVal lpValueName As String, ByVal lpReserved As Long, lpType As Long, ByVal lpData As String, lpcbData As Long) As Long
Private Declare Function RegQueryValueExLong Lib "advapi32.dll" Alias "RegQueryValueExA" (ByVal hKey As Long, ByVal lpValueName As String, ByVal lpReserved As Long, lpType As Long, lpData As Long, lpcbData As Long) As Long
Private Declare Function RegQueryValueExNULL Lib "advapi32.dll" Alias "RegQueryValueExA" (ByVal hKey As Long, ByVal lpValueName As String, ByVal lpReserved As Long, lpType As Long, ByVal lpData As Long, lpcbData As Long) As Long
Private Declare Function RegEnumKey Lib "advapi32.dll" Alias "RegEnumKeyA" (ByVal hKey As Long, ByVal dwIndex As Long, ByVal lpName As String, ByVal cbName As Long) As Long
Private Declare Function RegSetValueEx Lib "advapi32.dll" Alias "RegSetValueExA" (ByVal hKey As Long, ByVal lpValueName As String, ByVal Reserved As Long, ByVal dwType As Long, lpData As Any, ByVal cbData As Long) As Long
Private Declare Function RegDeleteKey Lib "advapi32.dll" Alias "RegDeleteKeyA" (ByVal hKey As Long, ByVal lpSubKey As String) As Long
Private Declare Sub SetWindowPos Lib "user32" (ByVal hWnd As Long, ByVal hWndInsertAfter As Long, ByVal X As Long, ByVal Y As Long, ByVal cx As Long, ByVal cy As Long, ByVal wFlags As Long)
Private Declare Function CreateFile Lib "kernel32" Alias "CreateFileA" (ByVal lpFileName As String, ByVal dwDesiredAccess As Long, ByVal dwShareMode As Long, lpSecurityAttributes As SECURITY_ATTRIBUTES, ByVal dwCreationDisposition As Long, ByVal dwFlagsAndAttributes As Long, ByVal hTemplateFile As Long) As Long
Private Declare Function CloseHandle Lib "kernel32" (ByVal hObject As Long) As Long
Private Declare Function GetFileSize Lib "kernel32" (ByVal hFile As Long, lpFileSizeHigh As Long) As Long
Private Declare Function SetFilePointer Lib "kernel32" (ByVal hFile As Long, ByVal lDistanceToMove As Long, lpDistanceToMoveHigh As Long, ByVal dwMoveMethod As Long) As Long
Private Declare Function SetEndOfFile Lib "kernel32" (ByVal hFile As Long) As Long
Private Declare Function WriteFile Lib "kernel32" (ByVal hFile As Long, lpBuffer As Any, ByVal nNumberOfBytesToWrite As Long, lpNumberOfBytesWritten As Long, lpOverlapped As Any) As Long
Private Declare Function ReadFile Lib "kernel32" (ByVal hFile As Long, lpBuffer As Any, ByVal nNumberOfBytesToRead As Long, lpNumberOfBytesRead As Long, lpOverlapped As Any) As Long
Private Declare Function GetLastError Lib "kernel32" () As Long
Private Const REG_SZ As Long = 1 'REG_SZ represents a fixed-length text string.
Private Const REG_DWORD As Long = 4 'REG_DWORD represents data by a number that is 4 bytes long.
Private Const HKEY_CLASSES_ROOT = &H80000000 'The information stored here ensures that the correct program opens when you open a file by using Windows Explorer.
Private Const HKEY_CURRENT_USER = &H80000001 'Contains the root of the configuration information for the user who is currently logged on.
Private Const HKEY_LOCAL_MACHINE = &H80000002 'Contains configuration information particular to the computer (for any user).
Private Const HKEY_USERS = &H80000003 'Contains the root of all user profiles on the computer.
Private Const ERROR_SUCCESS = 0
Private Const ERROR_NONE = 0
Private Const KEY_QUERY_VALUE = &H1 'Required to query the values of a registry key.
Private Const KEY_ALL_ACCESS = &H3F 'Combines the STANDARD_RIGHTS_REQUIRED, KEY_QUERY_VALUE, KEY_SET_VALUE, KEY_CREATE_SUB_KEY, KEY_ENUMERATE_SUB_KEYS, KEY_NOTIFY, and KEY_CREATE_LINK access rights.
Private Const KEY_READ = &H20019
Private Const GENERIC_READ_WRITE As Long = &HC0000000
Private Const OPEN_EXISTING As Long = 3
Private Const FILE_ATTRIBUTE_NORMAL As Long = &H80
Private Const FILE_BEGIN As Long = 0
Private Const NO_ERROR As Long = 0
Private Const ERROR_FILE_NOT_FOUND = 2&
Private Const ERROR_PATH_NOT_FOUND = 3&
Private Const ERROR_BAD_FORMAT = 11&
Private Const SE_ERR_ACCESSDENIED = 5        ' access denied
Private Const SE_ERR_ASSOCINCOMPLETE = 27
Private Const SE_ERR_DDEBUSY = 30
Private Const SE_ERR_DDEFAIL = 29
Private Const SE_ERR_DDETIMEOUT = 28
Private Const SE_ERR_DLLNOTFOUND = 32
Private Const SE_ERR_FNF = 2                ' file not found
Private Const SE_ERR_NOASSOC = 31
Private Const SE_ERR_PNF = 3                ' path not found
Private Const SE_ERR_OOM = 8                ' out of memory
Private Const SE_ERR_SHARE = 26


Public Enum EShellShowConstants
    essSW_HIDE = 0
    essSW_MAXIMIZE = 3
    essSW_MINIMIZE = 6
    essSW_SHOWMAXIMIZED = 3
    essSW_SHOWMINIMIZED = 2
    essSW_SHOWNORMAL = 1
    essSW_SHOWNOACTIVATE = 4
    essSW_SHOWNA = 8
    essSW_SHOWMINNOACTIVE = 7
    essSW_SHOWDEFAULT = 10
    essSW_RESTORE = 9
    essSW_SHOW = 5
End Enum

Private Type SECURITY_ATTRIBUTES
    nLength As Long
    lpSecurityDescriptor As Long
    bInheritHandle As Long
End Type
 
Public aPath As String, uvPath As String
 
Private Function QueryValueEx(ByVal lhKey As Long, ByVal szValueName As String, vValue As Variant) As Long
Dim Data As Long
Dim retval As Long 'Return value of RegQuery functions
Dim lType As Long 'Determine data type of present data
Dim lValue As Long 'Long value
Dim sValue As String 'String value
On Local Error GoTo QueryValueExError
' Determine the size and type of data to be read
retval = RegQueryValueExNULL(lhKey, szValueName, 0&, lType, 0&, Data)
If retval <> ERROR_NONE Then Error 5
Select Case lType
    ' Determine strings
    Case REG_SZ:
        sValue = String(Data, 0)
        retval = RegQueryValueExString(lhKey, szValueName, 0&, lType, sValue, Data)
        If retval = ERROR_NONE Then
            vValue = Left$(sValue, Data - 1)
        Else
            vValue = Empty
        End If
    ' Determine DWORDS
    Case REG_DWORD:
        retval = RegQueryValueExLong(lhKey, szValueName, 0&, lType, lValue, Data)
        If retval = ERROR_NONE Then vValue = lValue
    Case Else
    'all other data types not supported
        retval = -1
End Select
QueryValueExError:
QueryValueEx = retval
Exit Function
End Function

Public Sub DoDebug(txt As String)
Open aPath & "debuglog.txt" For Append As #55
Print #55, txt
Close #55
End Sub

Public Function GetInstallDir() As String
On Local Error Resume Next
Dim r As String
GetInstallDir = ""
If Len(Dir(aPath & "override.txt")) = 0 Then ' override does not exist
    If Len(GetUtherverse3DInstallDir()) > 0 Then
        GetInstallDir = GetUtherverse3DInstallDir()
        Exit Function
    End If
    If Len(GetVV3DInstallDir()) > 0 Then
        GetInstallDir = GetVV3DInstallDir()
        Exit Function
    End If
    If Len(GetRude3DInstallDir()) > 0 Then
        GetInstallDir = GetRude3DInstallDir()
        Exit Function
    End If
    If Len(GetU3DQAInstallDir()) > 0 Then
        GetInstallDir = GetU3DQAInstallDir()
        Exit Function
    End If
Else ' override exists.  follow override order
    Open aPath & "override.txt" For Input As #100
    While Not EOF(100)
        Line Input #100, r
        r = Trim(r)
        If Len(r) > 0 Then ' see what to try first
            If LCase(Mid(r, 1, 3)) = "uth" Then 'Utherverse3D
                If Len(GetUtherverse3DInstallDir()) > 0 Then
                    GetInstallDir = GetUtherverse3DInstallDir()
                    Close #100
                    Exit Function
                End If
            End If
            If LCase(Mid(r, 1, 3)) = "vir" Then 'VirtualVancouver
                If Len(GetVV3DInstallDir()) > 0 Then
                    GetInstallDir = GetVV3DInstallDir()
                    Close #100
                    Exit Function
                End If
            End If
            If LCase(Mid(r, 1, 3)) = "rud" Then 'Rude
                If Len(GetRude3DInstallDir()) > 0 Then
                    GetInstallDir = GetRude3DInstallDir()
                    Close #100
                    Exit Function
                End If
            End If
            If LCase(Mid(r, 1, 3)) = "uvq" Then 'UVQA
                If Len(GetU3DQAInstallDir()) > 0 Then
                    GetInstallDir = GetU3DQAInstallDir()
                    Close #100
                    Exit Function
                End If
            End If
        End If
    Wend
    Close #100
End If
End Function

Private Function GetUtherverse3DInstallDir() As String ' New Stuffies
Dim lRetVal As Long         'result of the API functions
Dim hKey As Long         'handle of opened key
Dim vValue As Variant      'setting of queried value
lRetVal = RegOpenKeyEx(HKEY_LOCAL_MACHINE, "SOFTWARE\Utherverse Digital Inc\Utherverse 3D Client", 0, KEY_QUERY_VALUE, hKey) 'Open Key to Query a value
lRetVal = QueryValueEx(hKey, "InstallDir", vValue) 'Query (determine) the value stored
GetUtherverse3DInstallDir = vValue 'Set the Form's Caption to whatever text was stored
RegCloseKey (hKey) 'Close the Key
End Function

Private Function GetVV3DInstallDir() As String '
' C:\Program Files\Utherverse Digital Inc\Virtual Vancouver 3D Client
Dim lRetVal As Long         'result of the API functions
Dim hKey As Long         'handle of opened key
Dim vValue As Variant      'setting of queried value
lRetVal = RegOpenKeyEx(HKEY_LOCAL_MACHINE, "SOFTWARE\Utherverse Digital Inc\Virtual Vancouver 3D Client", 0, KEY_QUERY_VALUE, hKey) 'Open Key to Query a value
lRetVal = QueryValueEx(hKey, "InstallDir", vValue) 'Query (determine) the value stored
GetVV3DInstallDir = vValue 'Set the Form's Caption to whatever text was stored
RegCloseKey (hKey) 'Close the Key
End Function

Private Function GetRude3DInstallDir() As String '
' C:\Program Files\Utherverse Digital Inc\Virtual Vancouver 3D Client
Dim lRetVal As Long         'result of the API functions
Dim hKey As Long         'handle of opened key
Dim vValue As Variant      'setting of queried value
lRetVal = RegOpenKeyEx(HKEY_LOCAL_MACHINE, "SOFTWARE\Utherverse Digital Inc\Rude Virtual 3D Client", 0, KEY_QUERY_VALUE, hKey) 'Open Key to Query a value
lRetVal = QueryValueEx(hKey, "InstallDir", vValue) 'Query (determine) the value stored
GetRude3DInstallDir = vValue 'Set the Form's Caption to whatever text was stored
RegCloseKey (hKey) 'Close the Key
End Function

'SOFTWARE\Utherverse Digital Inc\Utherverse 3D Client QA
Private Function GetU3DQAInstallDir() As String '
' C:\Program Files\Utherverse Digital Inc\Virtual Vancouver 3D Client
Dim lRetVal As Long         'result of the API functions
Dim hKey As Long         'handle of opened key
Dim vValue As Variant      'setting of queried value
lRetVal = RegOpenKeyEx(HKEY_LOCAL_MACHINE, "SOFTWARE\Utherverse Digital Inc\Utherverse 3D Client QA", 0, KEY_QUERY_VALUE, hKey) 'Open Key to Query a value
lRetVal = QueryValueEx(hKey, "InstallDir", vValue) 'Query (determine) the value stored
GetU3DQAInstallDir = vValue 'Set the Form's Caption to whatever text was stored
RegCloseKey (hKey) 'Close the Key
End Function

'''''''''''''''''
Public Sub DeleteData(ByVal FileName As String, DeletePos As Long, DeleteLength As Long)
    '
    '  Made by Michael Ciurescu (CVMichael from vbforums.com)
    '  Original thread: [url]http://www.vbforums.com/showthread.php?t=433537[/url]
    '
    Const cBuffSize As Long = 262144 ' 256 KBytes
   
    Dim SA As SECURITY_ATTRIBUTES
    Dim FHandle As Long
    Dim FileLen As Double
    Dim Buffer() As Byte, BuffPtr As Long
   
    Dim BytesToRead As Long, BytesRead As Long
    Dim ReadPos As Double, WritePos As Double
   
    ' using API position 0 is the first byte, using VB functions position 1 is first byte
    ' so decrement by one to use the same standard...
    DeletePos = DeletePos - 1
    If DeletePos < 0 Then DeletePos = 0
   
    ' open the file
    FHandle = CreateFile(FileName, GENERIC_READ_WRITE, 0, SA, OPEN_EXISTING, FILE_ATTRIBUTE_NORMAL, 0)
   
    ' get file size
    FileLen = FileSizeDouble(FHandle)
    
    ' impossible size here.
    If FileLen = 4294967295# Then Exit Sub
    
    ' alocate memory
    ReDim Buffer(cBuffSize - 1)
   
    ' get memory pointer
    BuffPtr = VarPtr(Buffer(0))
   
    ' calculate read & write positions
    WritePos = DeletePos
    ReadPos = WritePos + DeleteLength
   
    ' shift the data to left
   
    Do Until ReadPos >= FileLen
        ' calculate how much data to read/write
        BytesToRead = dblMIN(cBuffSize, FileLen - ReadPos)
       
        ' copy and paste the data to the new location
        SeekPosDouble FHandle, ReadPos
        ReadFile FHandle, ByVal BuffPtr, BytesToRead, BytesRead, ByVal 0&
       
        SeekPosDouble FHandle, WritePos
        WriteFile FHandle, ByVal BuffPtr, BytesRead, BytesRead, ByVal 0&
       
        WritePos = WritePos + BytesRead
        ReadPos = WritePos + DeleteLength
    Loop

    If WritePos < FileLen Then
        ' Seek to where we need to truncate the file
        SeekPosDouble FHandle, WritePos
       
        ' truncate the file
        SetEndOfFile FHandle
    End If

    Erase Buffer
    If FHandle <> 0 Then CloseHandle FHandle
End Sub
 
Private Function dblMIN(ByVal V1 As Double, ByVal V2 As Double) As Double
    If V1 < V2 Then
        dblMIN = V1
    Else
        dblMIN = V2
    End If
End Function
 
Private Function SeekPosDouble(ByVal FHandle As Long, ByVal NewPos As Double) As Boolean
    Dim SizeLow As Long, SizeHigh As Long
   
    SizeLow = DoubleToLongs(NewPos, SizeHigh)
   
    SeekPosDouble = SeekPos(FHandle, SizeLow, SizeHigh)
End Function
 
Private Function SeekPos(ByVal FHandle As Long, ByVal NewPos As Long, Optional ByVal PosHigh As Long = 0) As Boolean
    Dim Ret As Long, dwError As Long
   
    Ret = SetFilePointer(FHandle, NewPos, PosHigh, FILE_BEGIN)
   
    If Ret = -1 Then
        dwError = GetLastError
        If dwError = NO_ERROR Then SeekPos = True
    Else
        SeekPos = True
    End If
End Function
 
Private Function FileSizeDouble(ByVal FHandle As Long) As Double
    Dim SizeLow As Long, SizeHigh As Long
   
    If FHandle <> 0 Then SizeLow = GetFileSize(FHandle, SizeHigh)
   
    FileSizeDouble = CDbl(SizeHigh) * (2 ^ 32) + LongToDouble(SizeLow)
End Function
 
Private Function LongToDouble(ByVal Lng As Long) As Double
    If Lng And &H80000000 = 0 Then
        LongToDouble = CDbl(Lng)
    Else
        LongToDouble = (Lng Xor &H80000000) + (2 ^ 31)
    End If
End Function
 
Private Function DoubleToLongs(ByVal Dbl As Double, ByRef SizeHigh As Long) As Long
    Dim SizeLowDbl As Double
   
    SizeHigh = Fix(Dbl / 4294967296#)
    SizeLowDbl = Dbl - SizeHigh * 4294967296#
   
    If SizeLowDbl > 2147483647 Then
        DoubleToLongs = CLng(SizeLowDbl - 2147483648#) Xor &H80000000
    Else
        DoubleToLongs = SizeLowDbl
    End If
End Function

Public Function ShellEx(ByVal sFIle As String, Optional ByVal eShowCmd As EShellShowConstants = essSW_SHOWDEFAULT, Optional ByVal sParameters As String = "", Optional ByVal sDefaultDir As String = "", Optional sOperation As String = "open", Optional Owner As Long = 0) As Boolean
Dim lR As Long
Dim lErr As Long, sErr As Long
    If (InStr(UCase$(sFIle), ".EXE") <> 0) Then
        eShowCmd = 0
    End If
    On Error Resume Next
    If (sParameters = "") And (sDefaultDir = "") Then
        lR = ShellExecuteForExplore(Owner, sOperation, sFIle, 0, 0, essSW_SHOWNORMAL)
    Else
        lR = ShellExecute(Owner, sOperation, sFIle, sParameters, sDefaultDir, eShowCmd)
    End If
    If (lR < 0) Or (lR > 32) Then
        ShellEx = True
    Else
        ' raise an appropriate error:
        lErr = vbObjectError + 1048 + lR
        Select Case lR
        Case 0
            lErr = 7: sErr = "Out of memory"
        Case ERROR_FILE_NOT_FOUND
            lErr = 53: sErr = "File not found"
        Case ERROR_PATH_NOT_FOUND
            lErr = 76: sErr = "Path not found"
        Case ERROR_BAD_FORMAT
            sErr = "The executable file is invalid or corrupt"
        Case SE_ERR_ACCESSDENIED
            lErr = 75: sErr = "Path/file access error"
        Case SE_ERR_ASSOCINCOMPLETE
            sErr = "This file type does not have a valid file association."
        Case SE_ERR_DDEBUSY
            lErr = 285: sErr = "The file could not be opened because the target application is busy. Please try again in a moment."
        Case SE_ERR_DDEFAIL
            lErr = 285: sErr = "The file could not be opened because the DDE transaction failed. Please try again in a moment."
        Case SE_ERR_DDETIMEOUT
            lErr = 286: sErr = "The file could not be opened due to time out. Please try again in a moment."
        Case SE_ERR_DLLNOTFOUND
            lErr = 48: sErr = "The specified dynamic-link library was not found."
        Case SE_ERR_FNF
            lErr = 53: sErr = "File not found"
        Case SE_ERR_NOASSOC
            sErr = "No application is associated with this file type."
        Case SE_ERR_OOM
            lErr = 7: sErr = "Out of memory"
        Case SE_ERR_PNF
            lErr = 76: sErr = "Path not found"
        Case SE_ERR_SHARE
            lErr = 75: sErr = "A sharing violation occurred."
        Case Else
            sErr = "An error occurred occurred whilst trying to open or print the selected file."
        End Select
               
        Err.Raise lErr, , App.EXEName & ".GShell", sErr
        ShellEx = False
    End If

End Function

