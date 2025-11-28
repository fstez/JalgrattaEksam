<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0"
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

    <xsl:template match="/">
        <html>
        <head>
            <title>Cycling Exam Schedule</title>
            <meta charset="UTF-8"/>
        </head>
        <body>

            <h2>Jalgrattasõidueksamite loetelu</h2>

            <table border="1" cellpadding="5">
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Place</th>
                    <th>Time</th>
                    <th>Duration (min)</th>
                    <th>Examiner</th>
                    <th>Category</th>
                </tr>

                <xsl:for-each select="exams/session/location/exam">
                    <tr>
                        <td><xsl:value-of select="@id"/></td>
                        <td><xsl:value-of select="../../@date"/></td>
                        <td><xsl:value-of select="../@place"/></td>
                        <td><xsl:value-of select="time"/></td>
                        <td><xsl:value-of select="duration"/></td>
                        <td><xsl:value-of select="examiner/@name"/></td>
                        <td><xsl:value-of select="category"/></td>
                    </tr>
                </xsl:for-each>

            </table>

        </body>
        </html>
    </xsl:template>

</xsl:stylesheet>

