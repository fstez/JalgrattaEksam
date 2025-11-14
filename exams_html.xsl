<?xml version="1.0"?>
<xsl:stylesheet version="1.0" 
        xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

  <xsl:output method="html" encoding="UTF-8" indent="yes"/>

  <xsl:template match="/">
    <html>
      <head>
        <title>Exams List</title>
        <style>
          table { width: 100%; border-collapse: collapse; }
          th, td { border: 1px solid black; padding: 8px; text-align: left; }
          th { background-color: #f2f2f2; }
        </style>
      </head>
      <body>
        <h2>Eksaami registreerimised / Exam registrations</h2>
        <table border="1">
          <tr>
            <th>ID</th>  
            <th>Date & Time</th>
            <th>Place</th>
            <th>Examiner</th>
            <th>Duration</th>
            <th>Type</th>
          </tr>
          <xsl:apply-templates select="exams/dim1/dim2/dim3"/>
          <tr>
            <td><xsl:value-of select="@id"/></td>
            <td><xsl:value-of select="@datetime"/> </td>
            <td><xsl:value-of select="@place"/></td>
            <td><xsl:value-of select="@examiner"/></td>
            <td><xsl:value-of select="@duration"/></td>
            <td><xsl:value-of select="@type"/></td>
          </tr>
        </xsl:for-each>
        </table>
      </body>
    </html>
  </xsl:template>
</xsl:stylesheet>
