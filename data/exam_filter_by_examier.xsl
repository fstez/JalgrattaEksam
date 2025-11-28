<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0"
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

    <!-- параметр: имя экзаменатора -->
    <xsl:param name="examinerName"/>

    <xsl:template match="/">
        <filteredExams>
            <xsl:for-each select="exams/session/location/exam[examiner/@name=$examinerName]">
                <exam id="{@id}">
                    <date><xsl:value-of select="../../@date"/></date>
                    <place><xsl:value-of select="../@place"/></place>
                    <time><xsl:value-of select="time"/></time>
                    <duration><xsl:value-of select="duration"/></duration>
                    <category><xsl:value-of select="category"/></category>
                </exam>
            </xsl:for-each>
        </filteredExams>
    </xsl:template>

</xsl:stylesheet>
