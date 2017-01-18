<%
dim fs,fo,x
set fs=Server.CreateObject("Scripting.FileSystemObject")
set fo=fs.GetFolder("c:\")

for each x in fo.SubFolders
  'Print the name of all files in the test folder
  Response.write("<a href='"& x.Name &"'>"& x.Name &"</a><br>")
next

Response.write("<hr>")

for each x in fo.files
  'Print the name of all files in the test folder
  Response.write("<a href='"& x.Name &"'>"& x.Name &"</a><br>")
next

set fo=nothing
set fs=nothing
%>
