VERSION 5.00
Begin VB.Form frm_stuff 
   BorderStyle     =   1  'Fixed Single
   ClientHeight    =   3195
   ClientLeft      =   150
   ClientTop       =   720
   ClientWidth     =   4680
   LinkTopic       =   "Form1"
   MaxButton       =   0   'False
   MinButton       =   0   'False
   ScaleHeight     =   3195
   ScaleWidth      =   4680
   StartUpPosition =   3  'Windows Default
   Begin VB.Menu mnu_menu 
      Caption         =   "The Menu"
      Begin VB.Menu mnu_option 
         Caption         =   "uvdesign Website"
         Index           =   0
      End
      Begin VB.Menu mnu_option 
         Caption         =   "uvtexture Website"
         Index           =   1
      End
      Begin VB.Menu mnu_option 
         Caption         =   "-"
         Index           =   2
      End
      Begin VB.Menu mnu_option 
         Caption         =   "Texture Lists"
         Index           =   3
         Begin VB.Menu mnu_suboptionTL 
            Caption         =   "Female Textures"
            Index           =   0
         End
         Begin VB.Menu mnu_suboptionTL 
            Caption         =   "Male Textures"
            Index           =   1
         End
         Begin VB.Menu mnu_suboptionTL 
            Caption         =   "Female Attachments"
            Index           =   2
         End
         Begin VB.Menu mnu_suboptionTL 
            Caption         =   "Male Attachments"
            Index           =   3
         End
      End
   End
End
Attribute VB_Name = "frm_stuff"
Attribute VB_GlobalNameSpace = False
Attribute VB_Creatable = False
Attribute VB_PredeclaredId = True
Attribute VB_Exposed = False
Private Sub mnu_option_Click(Index As Integer)
Select Case Index
    Case 0:
        Shell "http://uvdesign.jimdo.com"
    Case 1:
        ShellEx "http://www.uvtexture.com"
End Select
End Sub

Private Sub mnu_suboptionTL_Click(Index As Integer)
Select Case Index
Case 0:
Case 1:
Case 2:
Case 3:
End Select
End Sub
